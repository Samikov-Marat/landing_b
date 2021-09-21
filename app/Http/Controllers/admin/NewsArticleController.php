<?php

namespace App\Http\Controllers\admin;

use App\Classes\FileUploader;
use App\Classes\NewsArticleRepository;
use App\Http\Controllers\Controller;
use App\NewsArticle;
use App\NewsArticleText;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class NewsArticleController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $site = NewsArticleRepository::getInstance()
            ->withLanguages()
            ->withNewsArticles()
            ->getSite($request->input('site_id'));
        return view('admin.news_articles.index')
            ->with('site', $site);
    }

    public function edit($id = null, Request $request)
    {
        if (isset($id)) {
            $newsArticle = NewsArticle::select(
                [
                    'id',
                    'site_id',
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
                ->find($id);
            $siteId = $newsArticle->site_id;
        } else {
            $newsArticle = null;
            $siteId = $request->input('site_id');
        }

        $site = NewsArticleRepository::getInstance()
            ->withLanguages()
            ->getSite($siteId);

        return view('admin.news_articles.form')
            ->with('site', $site)
            ->with('newsArticle', $newsArticle);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $newsArticle = NewsArticle::find($request->input('id'));
        } else {
            $newsArticle = new NewsArticle();
        }
        $newsArticle->site_id = $request->input('site_id');
        $newsArticle->language_id = $request->input('language_id');
        $newsArticle->header = $request->input('header', '');
        $newsArticle->note = $request->input('note', '');
        $newsArticle->text = $request->input('text', '');
        $newsArticle->publication_date_text = $request->input('publication_date_text', '');
        $newsArticle->publication_date = $request->input('publication_date') . ' ' . $request->input(
                'publication_date_time'
            );
        $newsArticle->save();

        FileUploader::to($newsArticle, 'preview')
            ->from($request, 'preview')
            ->setDisk('news_images')
            ->store();

        FileUploader::to($newsArticle, 'image')
            ->from($request, 'image')
            ->setDisk('news_images')
            ->store();

        FileUploader::to($newsArticle, 'image2')
            ->from($request, 'image2')
            ->setDisk('news_images')
            ->store();

        FileUploader::to($newsArticle, 'mobile')
            ->from($request, 'mobile')
            ->setDisk('news_images')
            ->store();

        FileUploader::to($newsArticle, 'mobile2')
            ->from($request, 'mobile2')
            ->setDisk('news_images')
            ->store();

        $newsArticle->save();

        return response()->redirectToRoute('admin.news_articles.index', ['site_id' => $newsArticle->site_id]);
    }

    public function delete(Request $request)
    {
        $newsArticle = NewsArticle::select('id', 'site_id')
            ->find($request->input('id'));
        $site_id = $newsArticle->site_id;
        $newsArticle->delete();
        return response()->redirectToRoute('admin.news_articles.index', ['site_id' => $site_id]);
    }


}
