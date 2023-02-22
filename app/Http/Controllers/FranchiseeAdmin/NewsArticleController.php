<?php

namespace App\Http\Controllers\FranchiseeAdmin;

use App\Classes\FranchiseeAdmin\FranchiseeAccess;
use App\Classes\FranchiseeAdmin\NewsArticleTextHelper;
use App\Classes\FileUploader;
use App\Classes\FranchiseeAdmin\FranchiseeNewsArticleRepository;
use App\FranchiseeNewsArticle;
use App\Http\Controllers\Controller;
use App\Site;

use Illuminate\Http\Request;

class NewsArticleController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $franchiseeAccess = new FranchiseeAccess();
        $franchisee = $franchiseeAccess->getFranchisee();

        FranchiseeNewsArticleRepository::getInstance($franchisee)->load();

        $localOffice = $franchisee->localOffices()
            ->firstOrFail();
        $localOffice->load('site');
        $site = $localOffice->site;
        $franchiseeAccess->checkSite($site);

        return view('franchisee_admin.news_articles.index')
            ->with('site', $site)
            ->with('franchisee', $franchisee)
            ->with('localOffice', $localOffice);
    }

    public function edit(Request $request, $id = null)
    {
        $franchiseeAccess = new FranchiseeAccess();
        $franchisee = $franchiseeAccess->getFranchisee();
        if (isset($id)) {
            $newsArticle = FranchiseeNewsArticle::with(['franchiseeNewsArticleTexts',])
                ->findOrFail($id)
                ->load('franchisee');
            $franchiseeAccess->checkAllow($newsArticle->franchisee);
        } else {
            $newsArticle = new FranchiseeNewsArticle();
            $newsArticle->franchisee_id = $franchisee->id;
        }

        $localOffice = $franchisee->localOffices()
            ->firstOrFail();
        $localOffice->load('site');
        $site = $localOffice->site;
        $franchiseeAccess->checkSite($site);

        return view('franchisee_admin.news_articles.form')
            ->with('site', $site)
            ->with('franchisee', $franchisee)
            ->with('newsArticle', $newsArticle);
    }

    public function save(Request $request)
    {
        $franchiseeAccess = new FranchiseeAccess();
        $franchisee = $franchiseeAccess->getFranchisee();

        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $franchiseeNewsArticle = FranchiseeNewsArticle::findOrFail($request->input('id'));
            $franchiseeNewsArticle->load('franchisee');
            $franchiseeAccess->checkAllow($franchiseeNewsArticle->franchisee);
        } else {
            $franchiseeNewsArticle = new FranchiseeNewsArticle();
            $franchiseeNewsArticle->franchisee_id =$franchisee->id;
        }
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

        $localOffice = $franchisee->localOffices()
            ->firstOrFail();

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
        $franchiseeAccess = new FranchiseeAccess();
        $newsArticle = FranchiseeNewsArticle::find($request->input('id'));
        $newsArticle->load('franchisee');
        $franchiseeAccess->checkAllow($newsArticle->franchisee);
        $newsArticle->delete();
        return response()->redirectToRoute('admin.franchisee_admin.news_articles.index');
    }
}
