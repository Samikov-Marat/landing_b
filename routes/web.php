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

Route::middleware(['http.secure', 'start.session', 'share.errors.from.session'])->group(function(){
    Auth::routes(['register' => false]);
});

Route::prefix('admin')->middleware(['auth', 'user.route.access', 'http.secure', 'verify.csrf.token', 'start.session', 'share.errors.from.session'])->group(
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

        Route::get('sites/clone-form/{id}', 'admin\SiteController@cloneForm')
            ->name('admin.sites.clone_form');
        Route::post('sites/clone', 'admin\SiteController@clone')
            ->name('admin.sites.clone');


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
        Route::get('languages/search-iso', 'admin\LanguageController@searchIso')
            ->name('admin.languages.search_iso');


        Route::get('feedbacks', 'admin\FeedbackController@index')
            ->name('admin.feedbacks.index');
        Route::get('feedbacks/add', 'admin\FeedbackController@edit')
            ->name('admin.feedbacks.add');
        Route::get('feedbacks/edit/{id}', 'admin\FeedbackController@edit')
            ->name('admin.feedbacks.edit');
        Route::post('feedbacks/save', 'admin\FeedbackController@save')
            ->name('admin.feedbacks.save');
        Route::post('feedbacks/delete', 'admin\FeedbackController@delete')
            ->name('admin.feedbacks.delete');


        Route::get('local-office-photos', 'admin\LocalOfficePhotoController@index')
            ->name('admin.local_office_photos.index');
        Route::get('local-office-photos/add', 'admin\LocalOfficePhotoController@edit')
            ->name('admin.local_office_photos.add');
        Route::get('local-office-photos/edit/{id}', 'admin\LocalOfficePhotoController@edit')
            ->name('admin.local_office_photos.edit');
        Route::post('local-office-photos/save', 'admin\LocalOfficePhotoController@save')
            ->name('admin.local_office_photos.save');
        Route::post('local-office-photos/delete', 'admin\LocalOfficePhotoController@delete')
            ->name('admin.local_office_photos.delete');
        Route::post('local-office-photos/move', 'admin\LocalOfficePhotoController@move')
            ->name('admin.local_office_photos.move');


        Route::get('local-offices', 'admin\LocalOfficeController@index')
            ->name('admin.local_offices.index');
        Route::get('local-offices/add', 'admin\LocalOfficeController@edit')
            ->name('admin.local_offices.add');
        Route::get('local-offices/edit/{id}', 'admin\LocalOfficeController@edit')
            ->name('admin.local_offices.edit');
        Route::post('local-offices/save', 'admin\LocalOfficeController@save')
            ->name('admin.local_offices.save')
            ->withoutMiddleware(\App\Http\Middleware\TrimStrings::class);
        Route::post('local-offices/delete', 'admin\LocalOfficeController@delete')
            ->name('admin.local_offices.delete');
        Route::post('local-offices/move', 'admin\LocalOfficeController@move')
            ->name('admin.local_offices.move');

        Route::get('our-workers', 'admin\OurWorkerController@index')
            ->name('admin.our_workers.index');
        Route::get('our-workers/add', 'admin\OurWorkerController@edit')
            ->name('admin.our_workers.add');
        Route::get('our-workers/edit/{id}', 'admin\OurWorkerController@edit')
            ->name('admin.our_workers.edit');
        Route::post('our-workers/save', 'admin\OurWorkerController@save')
            ->name('admin.our_workers.save')
            ->withoutMiddleware(\App\Http\Middleware\TrimStrings::class);
        Route::post('our-workers/delete', 'admin\OurWorkerController@delete')
            ->name('admin.our_workers.delete');
        Route::post('our-workers/move', 'admin\OurWorkerController@move')
            ->name('admin.our_workers.move');

        Route::get('news-articles', 'admin\NewsArticleController@index')
            ->name('admin.news_articles.index');
        Route::get('news-articles/add', 'admin\NewsArticleController@edit')
            ->name('admin.news_articles.add');
        Route::get('news-articles/edit/{id}', 'admin\NewsArticleController@edit')
            ->name('admin.news_articles.edit');
        Route::post('news-articles/save', 'admin\NewsArticleController@save')
            ->name('admin.news_articles.save')
            ->withoutMiddleware(\App\Http\Middleware\TrimStrings::class);
        Route::post('news-articles/delete', 'admin\NewsArticleController@delete')
            ->name('admin.news_articles.delete');

        Route::get('images', 'admin\ImageController@index')
            ->name('admin.images.index');
        Route::get('images/add', 'admin\ImageController@edit')
            ->name('admin.images.add');
        Route::get('images/edit/{id}', 'admin\ImageController@edit')
            ->name('admin.images.edit');
        Route::post('images/save', 'admin\ImageController@save')
            ->name('admin.images.save');
        Route::post('images/delete', 'admin\ImageController@delete')
            ->name('admin.images.delete');
        Route::post('images/move', 'admin\ImageController@move')
            ->name('admin.images.move');


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
            ->name('admin.texts.save')
            ->withoutMiddleware(\App\Http\Middleware\TrimStrings::class);
        Route::get('texts/download', 'admin\TextController@download')
            ->name('admin.texts.download');
        Route::post('texts/upload', 'admin\TextController@upload')
            ->name('admin.texts.upload');

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
        Route::any('permissions/generate', 'admin\PermissionController@generate')
            ->name('admin.permissions.generate');

        Route::get('roles', 'admin\RoleController@index')
            ->name('admin.roles.index');
        Route::get('roles/add', 'admin\RoleController@edit')
            ->name('admin.roles.add');
        Route::get('roles/edit/{id}', 'admin\RoleController@edit')
            ->name('admin.roles.edit');
        Route::post('roles/save', 'admin\RoleController@save')
            ->name('admin.roles.save');
        Route::post('roles/delete', 'admin\RoleController@delete')
            ->name('admin.roles.delete');
        Route::post('roles/move', 'admin\RoleController@move')
            ->name('admin.roles.move');
        Route::get('roles/edit-permission-list', 'admin\RoleController@editPermissionList')
            ->name('admin.roles.edit_permission_list');
        Route::post('roles/save-permission-list', 'admin\RoleController@savePermissionList')
            ->name('admin.roles.save_permission_list');


        Route::get('users', 'admin\UserController@index')
            ->name('admin.users.index');
        Route::get('users/add', 'admin\UserController@edit')
            ->name('admin.users.add');
        Route::get('users/edit/{id}', 'admin\UserController@edit')
            ->name('admin.users.edit');
        Route::post('users/save', 'admin\UserController@save')
            ->name('admin.users.save');
        Route::post('users/delete', 'admin\UserController@delete')
            ->name('admin.users.delete');
        Route::get('users/edit-role-list', 'admin\UserController@editRoleList')
            ->name('admin.users.edit_role_list');
        Route::post('users/save-role-list', 'admin\UserController@saveRoleList')
            ->name('admin.users.save_role_list');
        Route::get('users/permission-tree', 'admin\UserController@permissionTree')
            ->name('admin.users.permission_tree');

        Route::get('top-offices', 'admin\TopOfficeController@index')
            ->name('admin.top_offices.index');
        Route::get('top-offices/add', 'admin\TopOfficeController@edit')
            ->name('admin.top_offices.add');
        Route::get('top-offices/edit/{id}', 'admin\TopOfficeController@edit')
            ->name('admin.top_offices.edit');
        Route::post('top-offices/save', 'admin\TopOfficeController@save')
            ->name('admin.top_offices.save');
        Route::post('top-offices/delete', 'admin\TopOfficeController@delete')
            ->name('admin.top_offices.delete');
        Route::get('top-offices/search', 'admin\TopOfficeController@search')
            ->name('admin.top_offices.search');
        Route::post('top-offices/move', 'admin\TopOfficeController@move')
            ->name('admin.top_offices.move');


        Route::get('world-languages', 'admin\WorldLanguageController@index')
            ->name('admin.world_languages.index');
        Route::get('world-languages/add', 'admin\WorldLanguageController@edit')
            ->name('admin.world_languages.add');
        Route::get('world-languages/edit/{id}', 'admin\WorldLanguageController@edit')
            ->name('admin.world_languages.edit');
        Route::post('world-languages/save', 'admin\WorldLanguageController@save')
            ->name('admin.world_languages.save');
        Route::post('world-languages/delete', 'admin\WorldLanguageController@delete')
            ->name('admin.world_languages.delete');
        Route::post('world-languages/move', 'admin\WorldLanguageController@move')
            ->name('admin.world_languages.move');
        Route::get('world-languages/search-iso', 'admin\WorldLanguageController@searchIso')
            ->name('admin.world_languages.search_iso');

        Route::get('top-office-world-languages', 'admin\TopOfficeWorldLanguageController@index')
            ->name('admin.top_office_world_languages.index');
        Route::get('top-office-world-languages/edit', 'admin\TopOfficeWorldLanguageController@edit')
            ->name('admin.top_office_world_languages.edit');
        Route::post('top-office-world-languages/save', 'admin\TopOfficeWorldLanguageController@save')
            ->name('admin.top_office_world_languages.save');

        Route::get('yandex-metrica-goals', 'admin\YandexMetricaGoalController@index')
            ->name('admin.yandex_metrica_goals.index');
        Route::get('yandex-metrica-goals/add', 'admin\YandexMetricaGoalController@edit')
            ->name('admin.yandex_metrica_goals.add');
        Route::get('yandex-metrica-goals/edit/{id}', 'admin\YandexMetricaGoalController@edit')
            ->name('admin.yandex_metrica_goals.edit');
        Route::post('yandex-metrica-goals/save', 'admin\YandexMetricaGoalController@save')
            ->name('admin.yandex_metrica_goals.save');
        Route::post('yandex-metrica-goals/delete', 'admin\YandexMetricaGoalController@delete')
            ->name('admin.yandex_metrica_goals.delete');
        Route::get('yandex-metrica-goals/yandex-auth', 'admin\YandexMetricaGoalController@yandexAuth')
            ->name('admin.yandex_metrica_goals.yandex_auth');
        Route::get('yandex-metrica-goals/save-yandex-auth', 'admin\YandexMetricaGoalController@saveYandexAuth')
            ->name('admin.yandex_metrica_goals.save_yandex_auth');
        Route::get('yandex-metrica-goals/yandex-form', 'admin\YandexMetricaGoalController@yandexForm')
            ->name('admin.yandex_metrica_goals.yandex_form');
        Route::post('yandex-metrica-goals/clone-goals-to-yandex', 'admin\YandexMetricaGoalController@cloneGoalsToYandex')
            ->name('admin.yandex_metrica_goals.clone_goals_to_yandex');

        //тарифы
        Route::get('tariffs', 'admin\TariffController@index')
            ->name('admin.tariffs.index');
        Route::get('tariffs/edit/{id}', 'admin\TariffController@edit')
            ->name('admin.tariffs.edit');
        Route::post('tariffs/delete', 'admin\TariffController@delete')
            ->name('admin.tariffs.delete');
        Route::post('tariffs/save', 'admin\TariffController@save')
            ->name('admin.tariffs.save');
        Route::get('tariffs/add', 'admin\TariffController@edit')
            ->name('admin.tariffs.add');

        //тарифы переводы
        Route::get('tariff-translation', 'admin\TariffTranslationController@index')
            ->name('admin.tariff_translation.index');
        Route::get('tariff-translation/{language}', 'admin\TariffTranslationController@translationList')
            ->name('admin.tariff_translation.translation_list');
        Route::get('tariff-translation/{language}/edit', 'admin\TariffTranslationController@edit')
            ->name('admin.tariff_translation.edit');
        Route::post('tariff-translation/save', 'admin\TariffTranslationController@save')
            ->name('admin.tariff_translation.save');
        Route::get('site-tariffs', 'admin\TariffTranslationController@siteTariffs')
            ->name('admin.tariffs.site_tariffs');

        //типы тарифов
        Route::get('tariff-types', 'admin\TariffTypeController@index')
            ->name('admin.tariff_types.index');
        Route::get('tariff-types/edit/{id}', 'admin\TariffTypeController@edit')
            ->name('admin.tariff_types.edit');
        Route::post('tariff-types/delete', 'admin\TariffTypeController@delete')
            ->name('admin.tariff_types.delete');
        Route::post('tariff-types/save', 'admin\TariffTypeController@save')
            ->name('admin.tariff_types.save');
        Route::get('tariff-types/add', 'admin\TariffTypeController@edit')
            ->name('admin.tariff_types.add');

        //переводы типов тарифов
        Route::get('tariff-types-translation', 'admin\TariffTypeTranslationController@index')
            ->name('admin.tariff_types_translation.index');
        Route::get('tariff-types-translation/{language}', 'admin\TariffTypeTranslationController@translationList')
            ->name('admin.tariff_types.translation_list');
        Route::get('tariff-types-translation/{language}/edit', 'admin\TariffTypeTranslationController@edit')
            ->name('admin.tariff_types_translation.edit');
        Route::post('tariff-types-translation/save', 'admin\TariffTypeTranslationController@save')
            ->name('admin.tariff_types_translation.save');


        // Категории вопросов страницы поддержки
        Route::get('support-categories', 'admin\SupportCategoryController@index')
            ->name('admin.support_categories.index');
        Route::get('support-categories/add', 'admin\SupportCategoryController@edit')
            ->name('admin.support_categories.add');
        Route::get('support-categories/edit', 'admin\SupportCategoryController@edit')
            ->name('admin.support_categories.edit');
        Route::post('support-categories/save', 'admin\SupportCategoryController@save')
            ->name('admin.support_categories.save');
        Route::post('support-categories/delete', 'admin\SupportCategoryController@delete')
            ->name('admin.support_categories.delete');
        Route::post('support-categories/delete', 'admin\SupportCategoryController@delete')
            ->name('admin.support_categories.delete');
        Route::post('support-categories/move', 'admin\SupportCategoryController@move')
            ->name('admin.support_categories.move');

        Route::get('support-questions', 'admin\SupportQuestionController@index')
            ->name('admin.support_questions.index');
        Route::get('support-questions/add', 'admin\SupportQuestionController@edit')
            ->name('admin.support_questions.add');
        Route::get('support-questions/edit', 'admin\SupportQuestionController@edit')
            ->name('admin.support_questions.edit');
        Route::post('support-questions/save', 'admin\SupportQuestionController@save')
            ->name('admin.support_questions.save');
        Route::post('support-questions/delete', 'admin\SupportQuestionController@delete')
            ->name('admin.support_questions.delete');
        Route::post('support-questions/move', 'admin\SupportQuestionController@move')
            ->name('admin.support_questions.move');
    }

);

Route::get('/', 'site\PageController@selectDefaultLanguage')
    ->middleware(['clear.get', 'save.utm.to.cookies', 'antifraud'])
    ->name('site.select_default_language');

Route::post('/request/send', 'site\RequestController@send')
    ->name('request.send')->middleware(['verify.recaptcha.token']);
Route::post('/request/feedback', 'site\RequestController@feedback')
    ->name('request.feedback')->middleware(['verify.recaptcha.token']);
Route::post('/request/support', 'site\RequestController@support')
    ->name('request.support')->middleware(['verify.recaptcha.token']);
Route::post('/request/order', 'site\RequestController@order')
    ->name('request.order')->middleware(['verify.recaptcha.token']);
Route::post('/request/presentation', 'site\RequestController@presentation')
    ->name('request.presentation');
Route::get('/request/get-office-list', 'site\RequestController@getOfficeList')
    ->name('request.get_office_list');
Route::post('/request/feedback-review', 'site\RequestController@feedbackReview')
    ->name('request.feedback_review')->middleware(['verify.recaptcha.token']);
Route::post('/request/allow-cookies', 'site\RequestController@allowCookies')
    ->name('request.allow_cookies');

Route::get('/request/images/{imageUrl}', 'site\RequestController@images')
    ->where('imageUrl', '.*')
    ->name('request.images');

Route::get('/{languageUrl}/{pageUrl?}/{category?}/{question?}', 'site\PageController@showPage')
    ->middleware(['clear.get', 'save.utm.to.cookies', 'antifraud', 'save.statistics',])
    ->where('category', '\d+')
    ->where('item', '\d+')
    ->name('site.support');

Route::get('/{languageUrl}/{pageUrl?}', 'site\PageController@showPage')
    ->middleware(['clear.get', 'save.utm.to.cookies', 'antifraud', 'save.statistics',])
    ->where('pageUrl', '.*')
    ->name('site.show_page');
