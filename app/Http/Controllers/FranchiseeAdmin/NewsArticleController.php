<?php

namespace App\Http\Controllers\FranchiseeAdmin;

use App\Classes\FranchiseeAdmin\NewsArticleTextHelper;
use App\Classes\FileUploader;
use App\Classes\FranchiseeAdmin\NewsArticleRepository;
use App\FranchiseeNewsArticle;
use App\Http\Controllers\Controller;
use App\Site;
use App\User;
use Illuminate\Http\Request;

class NewsArticleController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $user = User::select('id', 'name', 'email')
            ->findOrFail(auth()->id());

        $franchisee = NewsArticleRepository::getInstance()
            ->withFranchiseeNewsArticles()
            ->getFranchisee($user);

        $localOffice = $franchisee->localOffices()
            ->firstOrFail();
        $localOffice->load('site');
        $site = $localOffice->site;




        return view('franchisee_admin.news_articles.index')
            ->with('site', $site)
            ->with('franchisee', $franchisee)
            ->with('localOffice', $localOffice);
    }

    public function edit(Request $request, $id = null)
    {
        $user = User::select('id', 'name', 'email')
            ->findOrFail(auth()->id());

        $franchisee = $user->franchisees()->firstOrFail();

        $localOffice = $franchisee->localOffices()
            ->firstOrFail();


        if (isset($id)) {
            $newsArticle = NewsArticle::select(
                [
                    'id',
                    'franchisee_id',
                    'language_id',
                    'publication_date_text',
                    'publication_date',
                    'header',
                    'note',
                    'text',
                    'preview',
                    'image',
                    'image2',
                    'mobile',
                    'mobile2',
                ]
            )
                ->with([
                           'newsArticleTexts' => function ($query) {
                               $query->select(
                                   [
                                       'id',
                                       'language_id',
                                       'news_article_id',
                                       'publication_date_text',
                                       'header',
                                       'note',
                                       'text'
                                   ]
                               );
                           },
                       ])
                ->find($id);
        } else {
            $newsArticle = null;
        }
        $user = User::select('id', 'name', 'email')
            ->findOrFail(auth()->id());

        $franchisee = NewsArticleRepository::getInstance()
            ->withFranchiseeNewsArticles()
            ->getFranchisee($user);

        $localOffice = $franchisee->localOffices()
            ->firstOrFail();
        $localOffice->load('site');
        $site = $localOffice->site;

        return view('franchisee_admin.news_articles.form')
            ->with('site', $site)
            ->with('franchisee', $franchisee)
            ->with('newsArticle', $newsArticle);
    }

    public function save(Request $request)
    {
        $user = User::select('id', 'name', 'email')
            ->findOrFail(auth()->id());

        $franchisee = $user->franchisees()->firstOrFail();

        $localOffice = $franchisee->localOffices()
            ->firstOrFail();

        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $franchiseeNewsArticle = FranchiseeNewsArticle::find($request->input('id'));
        } else {
            $franchiseeNewsArticle = new FranchiseeNewsArticle();
        }
        $franchiseeNewsArticle->franchisee_id = $request->input('franchisee_id');
        $franchiseeNewsArticle->publication_date = $request->input('publication_date') .
            ' ' .
            $request->input('publication_date_time');
        $franchiseeNewsArticle->save();

        FileUploader::to($franchiseeNewsArticle, 'preview')
            ->from($request, 'preview')
            ->setDisk('franchisee_news_images')
            ->store();

        FileUploader::to($franchiseeNewsArticle, 'image')
            ->from($request, 'image')
            ->setDisk('franchisee_news_images')
            ->store();

        FileUploader::to($franchiseeNewsArticle, 'image2')
            ->from($request, 'image2')
            ->setDisk('franchisee_news_images')
            ->store();

        FileUploader::to($franchiseeNewsArticle, 'mobile')
            ->from($request, 'mobile')
            ->setDisk('franchisee_news_images')
            ->store();

        FileUploader::to($franchiseeNewsArticle, 'mobile2')
            ->from($request, 'mobile2')
            ->setDisk('franchisee_news_images')
            ->store();

        $franchiseeNewsArticle->save();

        $site = Site::select('id', 'name', 'domain')
            ->with('languages')
            ->find($localOffice->site_id);
        foreach ($site->languages as $language) {
            $franchiseeNewsArticleText = NewsArticleTextHelper::getInstance(
                $franchiseeNewsArticle->franchiseeNewsArticleTexts()
            )
                ->getFirstOrNewByLanguage($language->id);
            $franchiseeNewsArticleText->header = $request->input('header')[$language->id] ?? '';
            $franchiseeNewsArticleText->note = $request->input('note')[$language->id] ?? '';
            $franchiseeNewsArticleText->text = $request->input('text')[$language->id] ?? '';
            $franchiseeNewsArticleText->publication_date_text = $request->input(
                'publication_date_text'
            )[$language->id] ?? '';
            $franchiseeNewsArticleText->save();
        }

        return response()->redirectToRoute(
            'admin.franchisee_admin.news_articles.index',
            ['site_id' => $franchiseeNewsArticle->site_id]
        );
    }

    public function delete(Request $request)
    {
        $newsArticle = NewsArticle::select('id', 'site_id')
            ->find($request->input('id'));
        $site_id = $newsArticle->site_id;
        $newsArticle->delete();
        return response()->redirectToRoute('admin.franchisee_admin.news_articles.index', ['site_id' => $site_id]);
    }


}
