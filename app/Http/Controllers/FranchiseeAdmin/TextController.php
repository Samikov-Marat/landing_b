<?php

namespace App\Http\Controllers\FranchiseeAdmin;

use App\Classes\FranchiseeAdmin\TextRepository;
use App\FranchiseeText;
use App\Http\Controllers\Controller;
use App\Site;
use App\TextType;
use App\User;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index(Request $request)
    {
        $user = User::select('id', 'name', 'email')
            ->findOrFail(auth()->id());

        $franchisee = $user->franchisees()->firstOrFail();

        $localOffice = $franchisee->localOffices()
            ->firstOrFail();


        $site = Site::find($localOffice->site_id);
        $site->load('languages');
        $pages = TextRepository::getInstance($site)
            ->getPages();

        return view('franchisee_admin.texts.index')
            ->with('site', $site)
            ->with('pages', $pages);
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

        return view('franchisee_admin.texts.form')
            ->with('site', $site)
            ->with('textType', $textType);
    }

    public function save(Request $request)
    {
        $user = User::select('id', 'name', 'email')
            ->findOrFail(auth()->id());

        $franchisee = $user->franchisees()->firstOrFail();


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
                    'franchiseeTexts' => function ($query) {
                        $query->select('id', 'text_type_id', 'language_id', 'franchisee_id', 'value');
                    }
                ]
            )
            ->find($request->input('text_type_id'));

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
