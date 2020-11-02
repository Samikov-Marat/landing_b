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


Route::prefix('admin')->middleware('auth')->group(
    function () {
        Route::get('/', 'admin\IndexController@index')
            ->name('admin.index');
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


        Route::get('text-type', 'admin\TextTypeController@index')
            ->name('admin.text_types.index');
        Route::get('text-type/add', 'admin\TextTypeController@edit')
            ->name('admin.text_types.add');
        Route::get('text-type/edit/{id}', 'admin\TextTypeController@edit')
            ->name('admin.text_types.edit');
        Route::post('text-type/save', 'admin\TextTypeController@save')
            ->name('admin.text_types.save');
        Route::post('text-type/delete', 'admin\TextTypeController@delete')
            ->name('admin.text_types.delete');
        Route::post('text-type/move', 'admin\TextTypeController@move')
            ->name('admin.text_types.move');

        Route::get('texts', 'admin\TextController@index')
            ->name('admin.texts.index');
        Route::get('texts/edit', 'admin\TextController@edit')
            ->name('admin.texts.edit');
        Route::post('texts/save', 'admin\TextController@save')
            ->name('admin.texts.save');

        Route::get('permissions', 'admin\PermissionController@index')
            ->name('admin.permissions.index');
        Route::get('permissions/add', 'admin\PermissionController@edit')
            ->name('admin.permissions.add');
        Route::get('permissions/edit/{id}', 'admin\PermissionController@edit')
            ->name('admin.permissions.edit');
        Route::post('permissions/save', 'admin\PermissionController@save')
            ->name('admin.permissions.save');
        Route::post('permissions/delete', 'admin\PermissionController@delete')
            ->name('admin.permissions.delete');

    }
);

Route::get('/', 'site\PageController@selectDefaultLanguage')
    ->name('site.select_default_language');

Route::get('/{languageUrl}/{pageUrl?}', 'site\PageController@showPage')
    ->where('pageUrl', '.*')
    ->name('site.show_page');

