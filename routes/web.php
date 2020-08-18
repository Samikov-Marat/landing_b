<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Route::redirect('/', '/admin');
//
Route::get(
    '/admin',
    function () {
        return response()->redirectToRoute('admin.sites.index');
    }
)
    ->name('admin.index');

Route::prefix('admin')->middleware('auth')->group(
    function () {
//        Route::get('/', 'admin\IndexController@index')->name('admin.index');
        Route::get('sites', 'admin\SiteController@index')
            ->name('admin.sites.index');
        Route::get('sites/add', 'admin\SiteController@edit')
            ->name('admin.sites.add');
        Route::get('sites/edit/{id}', 'admin\SiteController@edit')
            ->name('admin.sites.edit');
        Route::post('sites/save', 'admin\SiteController@save')
            ->name('admin.sites.save');
        Route::post('sites/delete', 'admin\SiteController@delete')
            ->name('admin.sites.delete');
        Route::get('sites/edit-page-list', 'admin\SiteController@editPageList')
            ->name('admin.sites.edit_page_list');
        Route::post('sites/save-page-list', 'admin\SiteController@savePageList')
            ->name('admin.sites.save_page_list');

        Route::get('languages', 'admin\LanguageController@index')
            ->name('admin.languages.index');
        Route::get('languages/add', 'admin\LanguageController@edit')
            ->name('admin.languages.add');
        Route::get('languages/edit/{id}', 'admin\LanguageController@edit')
            ->name('admin.languages.edit');
        Route::post('languages/save', 'admin\LanguageController@save')
            ->name('admin.languages.save');
        Route::post('languages/delete', 'admin\LanguageController@delete')
            ->name('admin.languages.delete');
        Route::post('languages/move', 'admin\LanguageController@move')
            ->name('admin.languages.move');


        Route::get('pages', 'admin\PageController@index')
            ->name('admin.pages.index');
        Route::get('pages/add', 'admin\PageController@edit')
            ->name('admin.pages.add');
        Route::get('pages/edit/{id}', 'admin\PageController@edit')
            ->name('admin.pages.edit');
        Route::post('pages/save', 'admin\PageController@save')
            ->name('admin.pages.save');
        Route::post('pages/delete', 'admin\PageController@delete')
            ->name('admin.pages.delete');
        Route::post('pages/move', 'admin\PageController@move')
            ->name('admin.pages.move');

    }
);
