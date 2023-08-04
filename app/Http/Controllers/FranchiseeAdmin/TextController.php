<?php

namespace App\Http\Controllers\FranchiseeAdmin;

use App\Classes\FranchiseeAdmin\FranchiseeAccess;
use App\Classes\FranchiseeAdmin\TextRepository;
use App\FranchiseeText;
use App\Http\Controllers\Controller;
use App\Site;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index(Request $request)
    {
        $franchiseeAccess = new FranchiseeAccess();

        if ($request->has('site_id')) {
            // TODO: потом сделать параметр обязательным
            $site = Site::find($request->input('site_id'));
        } else {
            $franchisee = $franchiseeAccess->getFranchisee();
            $localOffice = $franchisee->localOffices()
                ->firstOrFail();
            $site = Site::find($localOffice->site_id);
        }
        $franchiseeAccess->checkSite($site);
        $site->load('languages');
        $pages = TextRepository::getInstance($site)
            ->getPages($franchiseeAccess->getFranchisee());
        return view('franchisee_admin.texts.index')
            ->with('site', $site)
            ->with('pages', $pages);
    }

    public function edit(Request $request)
    {
        $franchiseeAccess = new FranchiseeAccess();
        $franchisee = $franchiseeAccess->getFranchisee();

        $site = Site::select('id', 'name')
            ->find($request->input('site_id'));
        $franchiseeAccess->checkSite($site);

        $site->load(
            [
                'languages' => function ($query) {
                    $query->select('id', 'site_id', 'shortname', 'name')
                        ->orderBy('sort');
                }
            ]
        );

        $textType = TextRepository::getInstance($site)
            ->getTextType($request->input('text_type_id'), $franchisee);

        return view('franchisee_admin.texts.form')
            ->with('site', $site)
            ->with('textType', $textType);
    }

    public function save(Request $request)
    {
        $franchiseeAccess = new FranchiseeAccess();
        $franchisee = $franchiseeAccess->getFranchisee();

        $site = Site::select('id', 'name')
            ->find($request->input('site_id'));
        $franchiseeAccess->checkSite($site);

        $site->load(
            [
                'languages' => function ($query) {
                    $query->select('id', 'site_id', 'shortname', 'name')
                        ->orderBy('sort');
                }
            ]
        );

        $avaiableLanguages = $site->languages->keyBy('id');

        $textType = TextRepository::getInstance($site)
            ->getTextType($request->input('text_type_id'), $franchisee);

        $franchiseeTextsByLanguage = $textType->franchiseeTexts->keyBy('language_id');

        $values = $request->input('values');

        foreach ($values as $languageId => $value) {
            if (!$avaiableLanguages->has($languageId)) {
                throw new Exception('На этом сайте нет такого языка');
            }

            if ($franchiseeTextsByLanguage->has($languageId)) {
                $text = $franchiseeTextsByLanguage->get($languageId);
            } else {
                $text = new FranchiseeText();
                $text->text_type_id = $textType->id;
                $text->language_id = $languageId;
                $text->franchisee_id = $franchisee->id;
            }
            $text->value = $value ?? '';
            $text->save();
        }

        return response()->redirectToRoute('admin.franchisee_admin.texts.index', ['site_id' => $site->id]);
    }

}
