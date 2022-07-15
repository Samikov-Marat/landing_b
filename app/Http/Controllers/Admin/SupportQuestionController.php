<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Admin\SupportCategoryTree;
use App\Classes\Admin\SupportRepository;
use App\Http\Controllers\Controller;
use App\SupportCategory;
use App\SupportQuestion;
use Illuminate\Http\Request;

class SupportQuestionController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $supportCategory = SupportCategory::select(['id', 'site_id', 'parent_id'])
            ->with([
                       'supportQuestions' => function ($q) {
                           $q->orderBy('sort');
                       },
                       'supportQuestions.supportQuestionTexts',
                   ])
            ->find($request->input('category_id'));
        $site = SupportRepository::findSite($supportCategory->site_id);
        SupportRepository::loadCategoriesTo($site);
        $path = SupportCategoryTree::getInstance($site->supportCategories)
            ->getPath($supportCategory->id);


        return view('admin.support_questions.index')
            ->with('supportCategory', $supportCategory)
            ->with('site', $site)
            ->with('path', $path);
    }

    public function edit(Request $request)
    {
        if ($request->has('id')) {
            $supportQuestion = SupportQuestion::select('id', 'category_id', 'show_form')
                ->find($request->input('id'));
        } else {
            $supportQuestion = new SupportQuestion();
        }
        $supportQuestion->load('supportQuestionTexts');
        if ($supportQuestion->exists) {
            $supportCategory = SupportCategory::find($supportQuestion->category_id);
        } else {
            $supportCategory = SupportCategory::find($request->input('category_id'));
        }
        $site = SupportRepository::findSite($supportCategory->site_id);

        return view('admin.support_questions.form')
            ->with('supportQuestion', $supportQuestion)
            ->with('supportCategory', $supportCategory)
            ->with('site', $site);
    }

    public function save(Request $request)
    {
        if ($request->has('id')) {
            $supportQuestion = SupportQuestion::select('id', 'category_id')
                ->find($request->input('id'));
        } else {
            $supportQuestion = new SupportQuestion();
        }

        if ($request->has('show_form')) {
            $supportQuestion->show_form = $request->input('show_form');
        } else {
            $supportQuestion->show_form = false;
        }

        $supportCategory = SupportCategory::find($request->input('category_id'));
        $site = SupportRepository::findSite($supportCategory->site_id);

        $supportQuestion->category_id = $supportCategory->id;

        if (!$supportQuestion->exists) {
            $supportQuestion->sort = SupportQuestion::where('category_id', $supportCategory->id)
                    ->max('sort') + self::SORT_STEP;
        }
        $supportQuestion->save();

        $questions = $request->input('question');
        $answers = $request->input('answer');
        foreach ($site->languages as $language) {
            $supportQuestionText = $supportQuestion->supportQuestionTexts()
                ->firstOrNew([
                                 'question_id' => $supportQuestion->id,
                                 'language_id' => $language->id,
                             ]);
            $supportQuestionText->question = $questions[$language->id] ?? '';
            $supportQuestionText->answer = $answers[$language->id] ?? '';
            $supportQuestionText->save();
        }

        return response()
            ->redirectToRoute('admin.support_questions.index', ['category_id' => $supportCategory->id]);
    }


    public function move(Request $request)
    {
        $supportQuestion = SupportQuestion::select('id', 'category_id', 'sort')
            ->find($request->input('id'));
        $direction = $request->input('direction');
        if ('up' == $direction) {
            $sign = '<';
            $orderByDirection = 'desc';
        } elseif ('down' == $direction) {
            $sign = '>';
            $orderByDirection = 'asc';
        } else {
            throw new \Exception('Непонятное направление');
        }
        $otherSupportQuestion = SupportQuestion::select('id', 'sort')
            ->where('sort', $sign, $supportQuestion->sort)
            ->where('category_id', $supportQuestion->category_id)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $supportQuestion->sort;
        $supportQuestion->sort = $otherSupportQuestion->sort;
        $supportQuestion->save();
        $otherSupportQuestion->sort = $sort;
        $otherSupportQuestion->save();

        return response()
            ->redirectToRoute('admin.support_questions.index', ['category_id' => $supportQuestion->category_id]);
    }


    public function delete(Request $request)
    {
        $supportQuestion = SupportQuestion::find($request->input('id'));
        $supportCategory = SupportCategory::find($supportQuestion->category_id);
        $supportQuestion->supportQuestionTexts()->delete();
        $supportQuestion->delete();
        return response()
            ->redirectToRoute('admin.support_questions.index', ['category_id' => $supportCategory->id]);
    }


}
