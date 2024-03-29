<?php

namespace App\Classes;

use App\Language;
use App\Page;
use App\TextType;
use XMLWriter;

class SitemapXml
{
    private $pages;
    private $lastmod;
    private $site;
    private $supportCategories;

    private $stream = 'php://output';

    /**
     * @var XMLWriter
     */
    private $writer;

    public function __construct($pages)
    {
        $this->pages = $pages;
    }

    public function setSite($site)
    {
        $this->site = $site;
    }

    public function setLastmod($lastmod)
    {
        $this->lastmod = $lastmod;
    }

    public function setStream($stream)
    {
        $this->stream = $stream;
    }

    public function setSupportCategories($supportCategories)
    {
        $this->supportCategories = $supportCategories;
    }

    public function output()
    {
        $this->initWriter();
        $this->outputHeader();
        foreach ($this->site->languages as $language) {
            $this->showPages($language);
            $this->showSupportCategoriesAndQuestions($language);
        }
        $this->outputFooter();
    }

    private function showPages($language)
    {
        foreach ($this->pages as $page) {
            if ($this->needShowPage($language, $page)) {
                $this->outputUrlPage($language, $page);
            }
        }
    }

    private function needShowPage(Language $language, Page $page): bool
    {
        if ('privacy-policy' == $page->url) {
            $textType = TextType::where('shortname', 'footer_has_privacy_policy_page')
                ->first();
            $textType->loadCount(
                [
                    'texts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id)
                            ->where('value', '<>', '-');
                    }
                ]
            );
            return $textType->texts_count > 0;
        }
        if ('legal' == $page->url) {
            $textType = TextType::where('shortname', 'footer_has_legal_page')
                ->first();
            $textType->loadCount(
                [
                    'texts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id)
                            ->where('value', '<>', '-');
                    }
                ]
            );
            return $textType->texts_count > 0;
        }
        if ('business' == $page->url) {
            $textType = TextType::where('shortname', 'menu_business')
                ->first();
            $textType->loadCount(
                [
                    'texts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id)
                            ->where('value', '<>', '');
                    }
                ]
            );
            return $textType->texts_count > 0;
        }
        if ('franchise' == $page->url) {
            $textType = TextType::where('shortname', 'menu_franchise')
                ->first();
            $textType->loadCount(
                [
                    'texts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id)
                            ->where('value', '<>', '');
                    }
                ]
            );
            $textType2 = TextType::where('shortname', 'menu_franchise_link')
                ->first();
            $textType2->loadCount(
                [
                    'texts' => function ($q) use ($language) {
                        $q->where('language_id', $language->id)
                            ->where('value', '<>', '');
                    }
                ]
            );
            return ($textType->texts_count > 0) && (0 == $textType2->texts_count);
        }
        return true;
    }

    private function showSupportCategoriesAndQuestions($language)
    {
        foreach ($this->supportCategories as $supportCategory) {
            $this->outputUrlSupportCategory($language, $supportCategory);
            $this->showSupportQuestions($language, $supportCategory);
        }
    }

    private function showSupportQuestions($language, $supportCategory)
    {
        foreach ($supportCategory->supportQuestions as $supportQuestion) {
            $this->outputUrlSupportQuestion($language, $supportCategory, $supportQuestion);
        }
    }

    private function initWriter()
    {
        $this->writer = new XMLWriter;
    }

    private function outputHeader()
    {
        $this->writer->openURI($this->stream);
        $this->writer->startDocument('1.0', 'UTF-8');
        $this->writer->setIndent(1);
        $this->writer->startElement('urlset');  // start urlset
        $this->writer->startAttribute('xmlns');
        $this->writer->text('http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->writer->endAttribute();
    }

    private function outputUrlPage($language, $page)
    {
        $this->writer->setIndent(2);
        $this->writer->startElement('url');
        $this->writer->setIndent(3);
        $this->writer->startElement('loc');
        $url = route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => $page->url]);
        $this->writer->text($url);
        $this->writer->endElement();

        $this->writer->startElement('lastmod');
        $this->writer->text($this->lastmod->format('Y-m-d'));
        $this->writer->endElement();

        $this->writer->startElement('changefreq');
        $this->writer->text('monthly');
        $this->writer->endElement();

        $this->writer->startElement('priority');
        $this->writer->text('0.8');
        $this->writer->endElement();

        $this->writer->endElement();
    }

    private function outputUrlSupportCategory($language, $supportCategory)
    {
        $this->writer->setIndent(2);
        $this->writer->startElement('url');
        $this->writer->setIndent(3);
        $this->writer->startElement('loc');
        $url = route('site.support', [
            'languageUrl' => $language->uri,
            'pageUrl' => 'support',
            'category' => $supportCategory->id,
        ]);

        $this->writer->text($url);
        $this->writer->endElement();

        $this->writer->startElement('lastmod');
        $this->writer->text($this->lastmod->format('Y-m-d'));
        $this->writer->endElement();

        $this->writer->startElement('changefreq');
        $this->writer->text('monthly');
        $this->writer->endElement();

        $this->writer->startElement('priority');
        $this->writer->text('0.8');
        $this->writer->endElement();

        $this->writer->endElement();
    }

    private function outputUrlSupportQuestion($language, $supportCategory, $supportQuestion)
    {
        $this->writer->setIndent(2);
        $this->writer->startElement('url');
        $this->writer->setIndent(3);
        $this->writer->startElement('loc');
        $url = route('site.support', [
            'languageUrl' => $language->uri,
            'pageUrl' => 'support',
            'category' => $supportCategory->id,
            'question' => $supportQuestion->id,
        ]);

        $this->writer->text($url);
        $this->writer->endElement();

        $this->writer->startElement('lastmod');
        $this->writer->text($this->lastmod->format('Y-m-d'));
        $this->writer->endElement();

        $this->writer->startElement('changefreq');
        $this->writer->text('monthly');
        $this->writer->endElement();

        $this->writer->startElement('priority');
        $this->writer->text('0.8');
        $this->writer->endElement();

        $this->writer->endElement();
    }

    private function outputFooter()
    {
        $this->writer->endElement(); // finish urlset
        $this->writer->endDocument();
    }
}
