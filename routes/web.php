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

Route::redirect('/', '/admin');

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
    }
);
