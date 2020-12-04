<?php

namespace App\Http\Controllers\admin;

use App\Classes\TextCsv;
use App\Classes\TextRepository;
use App\Http\Controllers\Controller;
use App\Language;
use App\Site;
use App\Text;
use App\TextType;
use Illuminate\Http\Request;

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
                throw new \Exception('На этом сайте нет такого языка');
            }

            if ($textsByLanguage->has($languageId)) {
                $text = $textsByLanguage->get($languageId);
            } else {
                $text = new Text();
                $text->text_type_id = $textType->id;
                $text->language_id = $languageId;
            }
            $text->value = $value;
            $text->save();
        }


        return response()->redirectToRoute('admin.texts.index', ['site_id' => $request->input('site_id')]);
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
}
