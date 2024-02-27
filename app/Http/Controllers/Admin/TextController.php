<?php

namespace App\Http\Controllers\Admin;

use App\Classes\KeyNumberTextTypes;
use App\Classes\TextCsv;
use App\Classes\TextCsvParser;
use App\Classes\TextRepository;
use App\Classes\TextRepositoryKeyNumber;
use App\Http\Controllers\Controller;
use App\Site;
use App\Text;
use App\TextType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use ZipArchive;

class TextController extends Controller
{
    public function index(Request $request)
    {
        $site = TextRepository::getSite($request->input('site_id'));

        return view('admin.texts.index')
            ->with('site', $site);
    }

    public function edit(Request $request)
    {
        $site = Site::select('id', 'name')
            ->with(
                [
                    'languages' => function ($query) {
                        $query->select('id', 'site_id', 'shortname', 'name')
                            ->orderBy('sort');
                    }
                ]
            )
            ->find($request->input('site_id'));

        $textType = TextType::select('id', 'page_id', 'shortname', 'name', 'default_value')
            ->with(
                [
                    'texts' => function ($query) {
                        $query->select('id', 'text_type_id', 'language_id', 'value');
                    }
                ]
            )
            ->find($request->input('text_type_id'));

        return view('admin.texts.edit_modal_content')
            ->with('site', $site)
            ->with('textType', $textType);
    }

    public function save(Request $request)
    {
        $site = Site::select('id')
            ->with(
                [
                    'languages' => function ($query) {
                        $query->select('id', 'site_id');
                    }
                ]
            )
            ->find($request->input('site_id'));

        $avaiableLanguages = $site->languages->keyBy('id');


        $textType = TextType::select('id')
            ->with(
                [
                    'texts' => function ($query) {
                        $query->select('id', 'text_type_id', 'language_id', 'value');
                    }
                ]
            )
            ->find($request->input('text_type_id'));

        $textsByLanguage = $textType->texts->keyBy('language_id');

        $values = $request->input('values');

        foreach ($values as $languageId => $value) {
            if (!$avaiableLanguages->has($languageId)) {
                throw new Exception('На этом сайте нет такого языка');
            }

            if ($textsByLanguage->has($languageId)) {
                $text = $textsByLanguage->get($languageId);
            } else {
                $text = new Text();
                $text->text_type_id = $textType->id;
                $text->language_id = $languageId;
            }
            $text->value = $value ?? '';
            $text->save();
        }


        return response()->redirectToRoute('admin.texts.index', ['site_id' => $site->id]);
    }

    public function download(Request $request)
    {
        $site = TextRepository::getSite($request->input('site_id'));
        return response()->streamDownload(
            function () use ($site) {
                $csv = new TextCsv();
                $csv->start($site);
            },
            'lang' . $site->id . '.csv'
        );
    }

    public function downloadForKeyNumber(Request $request)
    {

        KeyNumberTextTypes::prepare();



        $sites = Site::select(['id', 'domain'])
            ->get();
        $zip = new ZipArchive();
        $filename = public_path('storage/keynumbers.zip');

        if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
            exit("Невозможно открыть <$filename>\n");
        }
        foreach ($sites as $siteMin) {
            $site = TextRepositoryKeyNumber::getSite($siteMin->id);
            $csv = new TextCsv();
            $csv->filter = [];
            $csv->onlyPages = true;
            $name = preg_replace('#[\\W]+#U', '_', $siteMin->domain);
            @mkdir(storage_path('app/public/keynumbers/'), 0755, true);
            $csv->streamName = storage_path(('app/public/keynumbers/' . $name . '.csv'));
            $csv->start($site);
            $zip->addFile(storage_path(('app/public/keynumbers/' . $name . '.csv')), $name . '.csv');
        }
        echo '<a href="' . \url('storage/keynumbers.zip') . '">' . \url('storage/keynumbers.zip') . '</a>';
        $zip->close();
    }

    public function upload(Request $request)
    {
        $site = Site::select('id')
            ->with(
                [
                    'languages' => function ($query) {
                        $query->select('id', 'site_id');
                    }
                ]
            )
            ->find($request->input('site_id'));

        try {
            $path = $request->file('file')
                ->store('admin/texts/upload');
            $parser = new TextCsvParser($site);
            $parser->parse($path);
        } catch (Exception $e) {
            abort(400, $e->getMessage());
        }
        return response()->redirectToRoute('admin.texts.index', ['site_id' => $site->id]);
    }

}
