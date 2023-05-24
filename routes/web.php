<?php

use App\Http\Middleware\TrimStrings;
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

Route::middleware(['http.secure', 'start.session', 'share.errors.from.session'])->group(function (
) {
    Auth::routes(['register' => false]);
});


Route::prefix('admin')->middleware(
    ['auth', 'http.secure', 'verify.csrf.token', 'start.session', 'share.errors.from.session']
)->group(
    function () {
        Route::get('franchisee-admin/welcome', 'FranchiseeAdmin\WelcomeController@index')
            ->name('admin.franchisee_admin.welcome');
        Route::get('franchisee-admin/texts', 'FranchiseeAdmin\TextController@index')
            ->name('admin.franchisee_admin.texts.index');
        Route::get('franchisee-admin/texts/edit', 'FranchiseeAdmin\TextController@edit')
            ->name('admin.franchisee_admin.texts.edit');
        Route::post('franchisee-admin/texts/save', 'FranchiseeAdmin\TextController@save')
            ->name('admin.franchisee_admin.texts.save');

        Route::get('franchisee-admin/news-articles', 'FranchiseeAdmin\NewsArticleController@index')
            ->name('admin.franchisee_admin.news_articles.index');
        Route::get('franchisee-admin/news-articles/add',
            'FranchiseeAdmin\NewsArticleController@edit')
            ->name('admin.franchisee_admin.news_articles.add');
        Route::get('franchisee-admin/news-articles/edit/{id}',
            'FranchiseeAdmin\NewsArticleController@edit')
            ->name('admin.franchisee_admin.news_articles.edit');
        Route::post('franchisee-admin/news-articles/save',
            'FranchiseeAdmin\NewsArticleController@save')
            ->name('admin.franchisee_admin.news_articles.save')
            ->withoutMiddleware(TrimStrings::class);
        Route::post('franchisee-admin/news-articles/delete',
            'FranchiseeAdmin\NewsArticleController@delete')
            ->name('admin.franchisee_admin.news_articles.delete');
    }
);

Route::prefix('admin')->middleware(
    [
        'auth',
        'user.route.access',
        'http.secure',
        'verify.csrf.token',
        'start.session',
        'share.errors.from.session',
    ]
)->group(
    function () {
        Route::get('/', 'Admin\IndexController@index')
            ->name('admin.index');
        Route::get('sites', 'Admin\SiteController@index')
            ->name('admin.sites.index');
        Route::get('sites/add', 'Admin\SiteController@edit')
            ->name('admin.sites.add');
        Route::get('sites/edit/{id}', 'Admin\SiteController@edit')
            ->name('admin.sites.edit');
        Route::post('sites/save', 'Admin\SiteController@save')
            ->name('admin.sites.save');
        Route::post('sites/delete', 'Admin\SiteController@delete')
            ->name('admin.sites.delete');
        Route::get('sites/edit-page-list', 'Admin\SiteController@editPageList')
            ->name('admin.sites.edit_page_list');
        Route::post('sites/save-page-list', 'Admin\SiteController@savePageList')
            ->name('admin.sites.save_page_list');
        Route::get('sites/edit-tariff-list', 'Admin\SiteController@editTariffList')
            ->name('admin.sites.edit_tariff_list');
        Route::post('sites/save-tariff-list', 'Admin\SiteController@saveTariffList')
            ->name('admin.sites.save_tariff_list');

        Route::get('sites/clone-form/{id}', 'Admin\SiteController@cloneForm')
            ->name('admin.sites.clone_form');
        Route::post('sites/clone', 'Admin\SiteController@clone')
            ->name('admin.sites.clone');


        Route::get('languages', 'Admin\LanguageController@index')
            ->name('admin.languages.index');
        Route::get('languages/add', 'Admin\LanguageController@edit')
            ->name('admin.languages.add');
        Route::get('languages/edit/{id}', 'Admin\LanguageController@edit')
            ->name('admin.languages.edit');
        Route::post('languages/save', 'Admin\LanguageController@save')
            ->name('admin.languages.save');
        Route::post('languages/delete', 'Admin\LanguageController@delete')
            ->name('admin.languages.delete');
        Route::post('languages/move', 'Admin\LanguageController@move')
            ->name('admin.languages.move');
        Route::get('languages/search-iso', 'Admin\LanguageController@searchIso')
            ->name('admin.languages.search_iso')
            ->middleware('debugbar.disable');


        Route::get('feedbacks', 'Admin\FeedbackController@index')
            ->name('admin.feedbacks.index');
        Route::get('feedbacks/add', 'Admin\FeedbackController@edit')
            ->name('admin.feedbacks.add');
        Route::get('feedbacks/edit/{id}', 'Admin\FeedbackController@edit')
            ->name('admin.feedbacks.edit');
        Route::post('feedbacks/save', 'Admin\FeedbackController@save')
            ->name('admin.feedbacks.save');
        Route::post('feedbacks/delete', 'Admin\FeedbackController@delete')
            ->name('admin.feedbacks.delete');


        Route::get('local-office-photos', 'Admin\LocalOfficePhotoController@index')
            ->name('admin.local_office_photos.index');
        Route::get('local-office-photos/add', 'Admin\LocalOfficePhotoController@edit')
            ->name('admin.local_office_photos.add');
        Route::get('local-office-photos/edit/{id}', 'Admin\LocalOfficePhotoController@edit')
            ->name('admin.local_office_photos.edit');
        Route::post('local-office-photos/save', 'Admin\LocalOfficePhotoController@save')
            ->name('admin.local_office_photos.save');
        Route::post('local-office-photos/delete', 'Admin\LocalOfficePhotoController@delete')
            ->name('admin.local_office_photos.delete');
        Route::post('local-office-photos/move', 'Admin\LocalOfficePhotoController@move')
            ->name('admin.local_office_photos.move');


        Route::get('{site}/local-offices', 'Admin\LocalOfficeController@index')
            ->name('admin.local_offices.index');
        Route::get('{site}/local-offices/create', 'Admin\LocalOfficeController@edit')
            ->name('admin.local_offices.create');
        Route::get('{site}/local-offices/{localOffice}/edit', 'Admin\LocalOfficeController@edit')
            ->name('admin.local_offices.edit')
            ->middleware('local.office.belong.to.site');
        Route::put('{site}/local-offices/{localOffice?}', 'Admin\LocalOfficeController@update')
            ->name('admin.local_offices.update')
            ->middleware('local.office.belong.to.site')
            ->withoutMiddleware(TrimStrings::class);
        Route::delete('{site}/local-offices/{localOffice}', 'Admin\LocalOfficeController@delete')
            ->name('admin.local_offices.delete')
            ->middleware('local.office.belong.to.site');
        Route::post('{site}/local-offices/{localOffice}/move', 'Admin\LocalOfficeController@move')
            ->name('admin.local_offices.move')
            ->middleware('local.office.belong.to.site');

        Route::get('our-workers', 'Admin\OurWorkerController@index')
            ->name('admin.our_workers.index');
        Route::get('our-workers/add', 'Admin\OurWorkerController@edit')
            ->name('admin.our_workers.add');
        Route::get('our-workers/edit/{id}', 'Admin\OurWorkerController@edit')
            ->name('admin.our_workers.edit');
        Route::post('our-workers/save', 'Admin\OurWorkerController@save')
            ->name('admin.our_workers.save')
            ->withoutMiddleware(TrimStrings::class);
        Route::post('our-workers/delete', 'Admin\OurWorkerController@delete')
            ->name('admin.our_workers.delete');
        Route::post('our-workers/move', 'Admin\OurWorkerController@move')
            ->name('admin.our_workers.move');

        Route::get('news-articles', 'Admin\NewsArticleController@index')
            ->name('admin.news_articles.index');
        Route::get('news-articles/add', 'Admin\NewsArticleController@edit')
            ->name('admin.news_articles.add');
        Route::get('news-articles/edit/{id}', 'Admin\NewsArticleController@edit')
            ->name('admin.news_articles.edit');
        Route::post('news-articles/save', 'Admin\NewsArticleController@save')
            ->name('admin.news_articles.save')
            ->withoutMiddleware(TrimStrings::class);
        Route::post('news-articles/delete', 'Admin\NewsArticleController@delete')
            ->name('admin.news_articles.delete');

        Route::get('images', 'Admin\ImageController@index')
            ->name('admin.images.index');
        Route::get('images/add', 'Admin\ImageController@edit')
            ->name('admin.images.add');
        Route::get('images/edit/{id}', 'Admin\ImageController@edit')
            ->name('admin.images.edit');
        Route::post('images/save', 'Admin\ImageController@save')
            ->name('admin.images.save');
        Route::post('images/delete', 'Admin\ImageController@delete')
            ->name('admin.images.delete');
        Route::post('images/move', 'Admin\ImageController@move')
            ->name('admin.images.move');


        Route::get('pages', 'Admin\PageController@index')
            ->name('admin.pages.index');
        Route::get('pages/add', 'Admin\PageController@edit')
            ->name('admin.pages.add');
        Route::get('pages/edit/{id}', 'Admin\PageController@edit')
            ->name('admin.pages.edit');
        Route::post('pages/save', 'Admin\PageController@save')
            ->name('admin.pages.save');
        Route::post('pages/delete', 'Admin\PageController@delete')
            ->name('admin.pages.delete');
        Route::post('pages/move', 'Admin\PageController@move')
            ->name('admin.pages.move');

        Route::get('franchisees', 'Admin\FranchiseeController@index')
            ->name('admin.franchisees.index');
        Route::get('franchisees/add', 'Admin\FranchiseeController@edit')
            ->name('admin.franchisees.add');
        Route::get('franchisees/edit/{id}', 'Admin\FranchiseeController@edit')
            ->name('admin.franchisees.edit');
        Route::post('franchisees/save', 'Admin\FranchiseeController@save')
            ->name('admin.franchisees.save');
        Route::post('franchisees/delete', 'Admin\FranchiseeController@delete')
            ->name('admin.franchisees.delete');
        Route::get('franchisees/add-user', 'Admin\FranchiseeController@addUser')
            ->name('admin.franchisees.add_user');
        Route::post('franchisees/save-user', 'Admin\FranchiseeController@saveUser')
            ->name('admin.franchisees.save_user');

        Route::get('text-type', 'Admin\TextTypeController@index')
            ->name('admin.text_types.index');
        Route::get('text-type/add', 'Admin\TextTypeController@edit')
            ->name('admin.text_types.add');
        Route::get('text-type/edit/{id}', 'Admin\TextTypeController@edit')
            ->name('admin.text_types.edit');
        Route::post('text-type/save', 'Admin\TextTypeController@save')
            ->name('admin.text_types.save');
        Route::post('text-type/delete', 'Admin\TextTypeController@delete')
            ->name('admin.text_types.delete');
        Route::post('text-type/move', 'Admin\TextTypeController@move')
            ->name('admin.text_types.move');

        Route::get('texts', 'Admin\TextController@index')
            ->name('admin.texts.index');
        Route::get('texts/edit', 'Admin\TextController@edit')
            ->name('admin.texts.edit');
        Route::post('texts/save', 'Admin\TextController@save')
            ->name('admin.texts.save')
            ->withoutMiddleware(TrimStrings::class);
        Route::get('texts/download', 'Admin\TextController@download')
            ->name('admin.texts.download');
        Route::post('texts/upload', 'Admin\TextController@upload')
            ->name('admin.texts.upload');

        Route::get('permissions', 'Admin\PermissionController@index')
            ->name('admin.permissions.index');
        Route::get('permissions/add', 'Admin\PermissionController@edit')
            ->name('admin.permissions.add');
        Route::get('permissions/edit/{id}', 'Admin\PermissionController@edit')
            ->name('admin.permissions.edit');
        Route::post('permissions/save', 'Admin\PermissionController@save')
            ->name('admin.permissions.save');
        Route::post('permissions/delete', 'Admin\PermissionController@delete')
            ->name('admin.permissions.delete');
        Route::any('permissions/generate', 'Admin\PermissionController@generate')
            ->name('admin.permissions.generate');

        Route::get('roles', 'Admin\RoleController@index')
            ->name('admin.roles.index');
        Route::get('roles/add', 'Admin\RoleController@edit')
            ->name('admin.roles.add');
        Route::get('roles/edit/{id}', 'Admin\RoleController@edit')
            ->name('admin.roles.edit');
        Route::post('roles/save', 'Admin\RoleController@save')
            ->name('admin.roles.save');
        Route::post('roles/delete', 'Admin\RoleController@delete')
            ->name('admin.roles.delete');
        Route::post('roles/move', 'Admin\RoleController@move')
            ->name('admin.roles.move');
        Route::get('roles/edit-permission-list', 'Admin\RoleController@editPermissionList')
            ->name('admin.roles.edit_permission_list');
        Route::post('roles/save-permission-list', 'Admin\RoleController@savePermissionList')
            ->name('admin.roles.save_permission_list');


        Route::get('users', 'Admin\UserController@index')
            ->name('admin.users.index');
        Route::get('users/add', 'Admin\UserController@edit')
            ->name('admin.users.add');
        Route::get('users/edit/{id}', 'Admin\UserController@edit')
            ->name('admin.users.edit');
        Route::post('users/save', 'Admin\UserController@save')
            ->name('admin.users.save');
        Route::post('users/delete', 'Admin\UserController@delete')
            ->name('admin.users.delete');
        Route::get('users/edit/{id}', 'Admin\UserController@edit')
            ->name('admin.users.edit');
        Route::get('users/reset-password-form/{id}', 'Admin\UserController@resetPasswordForm')
            ->name('admin.users.reset_password_form');
        Route::post('users/reset-password', 'Admin\UserController@resetPassword')
            ->name('admin.users.reset_password');
        Route::get('users/edit-role-list', 'Admin\UserController@editRoleList')
            ->name('admin.users.edit_role_list');
        Route::post('users/save-role-list', 'Admin\UserController@saveRoleList')
            ->name('admin.users.save_role_list');
        Route::get('users/permission-tree', 'Admin\UserController@permissionTree')
            ->name('admin.users.permission_tree');

        Route::get('top-offices', 'Admin\TopOfficeController@index')
            ->name('admin.top_offices.index');
        Route::get('top-offices/add', 'Admin\TopOfficeController@edit')
            ->name('admin.top_offices.add');
        Route::get('top-offices/edit/{id}', 'Admin\TopOfficeController@edit')
            ->name('admin.top_offices.edit');
        Route::post('top-offices/save', 'Admin\TopOfficeController@save')
            ->name('admin.top_offices.save');
        Route::post('top-offices/delete', 'Admin\TopOfficeController@delete')
            ->name('admin.top_offices.delete');
        Route::get('top-offices/search', 'Admin\TopOfficeController@search')
            ->name('admin.top_offices.search')
            ->middleware('debugbar.disable');
        Route::post('top-offices/move', 'Admin\TopOfficeController@move')
            ->name('admin.top_offices.move');


        Route::get('world-languages', 'Admin\WorldLanguageController@index')
            ->name('admin.world_languages.index');
        Route::get('world-languages/add', 'Admin\WorldLanguageController@edit')
            ->name('admin.world_languages.add');
        Route::get('world-languages/edit/{id}', 'Admin\WorldLanguageController@edit')
            ->name('admin.world_languages.edit');
        Route::post('world-languages/save', 'Admin\WorldLanguageController@save')
            ->name('admin.world_languages.save');
        Route::post('world-languages/delete', 'Admin\WorldLanguageController@delete')
            ->name('admin.world_languages.delete');
        Route::post('world-languages/move', 'Admin\WorldLanguageController@move')
            ->name('admin.world_languages.move');
        Route::get('world-languages/search-iso', 'Admin\WorldLanguageController@searchIso')
            ->name('admin.world_languages.search_iso')
            ->middleware('debugbar.disable');

        Route::get('top-office-world-languages', 'Admin\TopOfficeWorldLanguageController@index')
            ->name('admin.top_office_world_languages.index');
        Route::get('top-office-world-languages/edit', 'Admin\TopOfficeWorldLanguageController@edit')
            ->name('admin.top_office_world_languages.edit');
        Route::post('top-office-world-languages/save',
            'Admin\TopOfficeWorldLanguageController@save')
            ->name('admin.top_office_world_languages.save');

        Route::get('yandex-metrica-goals', 'Admin\YandexMetricaGoalController@index')
            ->name('admin.yandex_metrica_goals.index');
        Route::get('yandex-metrica-goals/add', 'Admin\YandexMetricaGoalController@edit')
            ->name('admin.yandex_metrica_goals.add');
        Route::get('yandex-metrica-goals/edit/{id}', 'Admin\YandexMetricaGoalController@edit')
            ->name('admin.yandex_metrica_goals.edit');
        Route::post('yandex-metrica-goals/save', 'Admin\YandexMetricaGoalController@save')
            ->name('admin.yandex_metrica_goals.save');
        Route::post('yandex-metrica-goals/delete', 'Admin\YandexMetricaGoalController@delete')
            ->name('admin.yandex_metrica_goals.delete');
        Route::get('yandex-metrica-goals/yandex-auth',
            'Admin\YandexMetricaGoalController@yandexAuth')
            ->name('admin.yandex_metrica_goals.yandex_auth');
        Route::get('yandex-metrica-goals/save-yandex-auth',
            'Admin\YandexMetricaGoalController@saveYandexAuth')
            ->name('admin.yandex_metrica_goals.save_yandex_auth');
        Route::get('yandex-metrica-goals/yandex-form',
            'Admin\YandexMetricaGoalController@yandexForm')
            ->name('admin.yandex_metrica_goals.yandex_form');
        Route::post(
            'yandex-metrica-goals/clone-goals-to-yandex',
            'Admin\YandexMetricaGoalController@cloneGoalsToYandex'
        )
            ->name('admin.yandex_metrica_goals.clone_goals_to_yandex');

        //тарифы
        Route::get('tariffs', 'Admin\TariffController@index')
            ->name('admin.tariffs.index');
        Route::get('tariffs/edit/{id}', 'Admin\TariffController@edit')
            ->name('admin.tariffs.edit');
        Route::post('tariffs/delete', 'Admin\TariffController@delete')
            ->name('admin.tariffs.delete');
        Route::post('tariffs/save', 'Admin\TariffController@save')
            ->name('admin.tariffs.save');
        Route::get('tariffs/add', 'Admin\TariffController@edit')
            ->name('admin.tariffs.add');

        //тарифы переводы
        Route::get('tariff-translation', 'Admin\TariffTranslationController@index')
            ->name('admin.tariff_translation.index');
        Route::get('tariff-translation/{language}',
            'Admin\TariffTranslationController@translationList')
            ->name('admin.tariff_translation.translation_list');
        Route::get('tariff-translation/{language}/edit', 'Admin\TariffTranslationController@edit')
            ->name('admin.tariff_translation.edit');
        Route::post('tariff-translation/save', 'Admin\TariffTranslationController@save')
            ->name('admin.tariff_translation.save');
        Route::get('site-tariffs', 'Admin\TariffTranslationController@siteTariffs')
            ->name('admin.tariffs.site_tariffs');

        //типы тарифов
        Route::get('tariff-types', 'Admin\TariffTypeController@index')
            ->name('admin.tariff_types.index');
        Route::get('tariff-types/edit/{id}', 'Admin\TariffTypeController@edit')
            ->name('admin.tariff_types.edit');
        Route::post('tariff-types/delete', 'Admin\TariffTypeController@delete')
            ->name('admin.tariff_types.delete');
        Route::post('tariff-types/save', 'Admin\TariffTypeController@save')
            ->name('admin.tariff_types.save');
        Route::get('tariff-types/add', 'Admin\TariffTypeController@edit')
            ->name('admin.tariff_types.add');

        //переводы типов тарифов
        Route::get('tariff-types-translation', 'Admin\TariffTypeTranslationController@index')
            ->name('admin.tariff_types_translation.index');
        Route::get('tariff-types-translation/{language}',
            'Admin\TariffTypeTranslationController@translationList')
            ->name('admin.tariff_types.translation_list');
        Route::get('tariff-types-translation/{language}/edit',
            'Admin\TariffTypeTranslationController@edit')
            ->name('admin.tariff_types_translation.edit');
        Route::post('tariff-types-translation/save', 'Admin\TariffTypeTranslationController@save')
            ->name('admin.tariff_types_translation.save');


        // Категории вопросов страницы поддержки
        Route::get('support-categories', 'Admin\SupportCategoryController@index')
            ->name('admin.support_categories.index');
        Route::get('support-categories/add', 'Admin\SupportCategoryController@edit')
            ->name('admin.support_categories.add');
        Route::get('support-categories/edit', 'Admin\SupportCategoryController@edit')
            ->name('admin.support_categories.edit');
        Route::post('support-categories/save', 'Admin\SupportCategoryController@save')
            ->name('admin.support_categories.save');
        Route::post('support-categories/delete', 'Admin\SupportCategoryController@delete')
            ->name('admin.support_categories.delete');
        Route::post('support-categories/delete', 'Admin\SupportCategoryController@delete')
            ->name('admin.support_categories.delete');
        Route::post('support-categories/move', 'Admin\SupportCategoryController@move')
            ->name('admin.support_categories.move');

        Route::get('support-questions', 'Admin\SupportQuestionController@index')
            ->name('admin.support_questions.index');
        Route::get('support-questions/add', 'Admin\SupportQuestionController@edit')
            ->name('admin.support_questions.add');
        Route::get('support-questions/edit', 'Admin\SupportQuestionController@edit')
            ->name('admin.support_questions.edit');
        Route::post('support-questions/save', 'Admin\SupportQuestionController@save')
            ->name('admin.support_questions.save');
        Route::post('support-questions/delete', 'Admin\SupportQuestionController@delete')
            ->name('admin.support_questions.delete');
        Route::post('support-questions/move', 'Admin\SupportQuestionController@move')
            ->name('admin.support_questions.move');

        Route::get('statistics', 'Admin\StatisticsController@index')
            ->name('admin.statistics.index');
        Route::get('statistics/search-sites', 'Admin\StatisticsController@searchSites')
            ->name('admin.statistics.search_sites')
            ->middleware('debugbar.disable');
        Route::get('statistics/search-utm-source', 'Admin\StatisticsController@searchUtmSource')
            ->name('admin.statistics.search_utm_source')
            ->middleware('debugbar.disable');
        Route::get('statistics/search-utm-medium', 'Admin\StatisticsController@searchUtmMedium')
            ->name('admin.statistics.search_utm_medium')
            ->middleware('debugbar.disable');
        Route::get('statistics/search-utm-campaign', 'Admin\StatisticsController@searchUtmCampaign')
            ->name('admin.statistics.search_utm_campaign')
            ->middleware('debugbar.disable');
        Route::get('statistics/search-utm-term', 'Admin\StatisticsController@searchUtmTerm')
            ->name('admin.statistics.search_utm_term')
            ->middleware('debugbar.disable');
        Route::get('statistics/search-utm-content', 'Admin\StatisticsController@searchUtmContent')
            ->name('admin.statistics.search_utm_content')
            ->middleware('debugbar.disable');

        Route::get('amo', 'Admin\AmoController@index')
            ->name('admin.amo.index');
        Route::get('amo/auth-form', 'Admin\AmoController@authForm')
            ->name('admin.amo.auth_form');
        Route::post('amo/auth-save', 'Admin\AmoController@authSave')
            ->name('admin.amo.auth_save');
    }

);

Route::get('/', 'Site\PageController@selectDefaultLanguage')
    ->middleware(['clear.get', 'save.utm.to.cookies', 'antifraud'])
    ->name('site.select_default_language');

Route::middleware('debugbar.disable')->group(function () {
    Route::post('/request/send', 'Site\RequestController@send')
        ->name('request.send')->middleware(['verify.recaptcha.token']);
    Route::post('/request/feedback', 'Site\RequestController@feedback')
        ->name('request.feedback')->middleware(['verify.recaptcha.token']);
    Route::post('/request/support', 'Site\RequestController@support')
        ->name('request.support')->middleware(['verify.recaptcha.token']);
    Route::post('/request/order', 'Site\RequestController@order')
        ->name('request.order')->middleware(['verify.recaptcha.token']);
    Route::post('/request/presentation', 'Site\RequestController@presentation')
        ->name('request.presentation');
    Route::get('/request/get-office-list', 'Site\RequestController@getOfficeList')
        ->name('request.get_office_list');
    Route::post('/request/feedback-review', 'Site\RequestController@feedbackReview')
        ->name('request.feedback_review')->middleware(['verify.recaptcha.token']);
    Route::post('/request/allow-cookies', 'Site\RequestController@allowCookies')
        ->name('request.allow_cookies');
    Route::post('/request/franchise', 'Site\RequestController@franchise')
        ->name('request.franchise');
    Route::post('/request/city', 'Site\RequestController@city')
        ->name('request.city');
    Route::post('/request/calculate', 'Site\RequestController@calculate')
        ->name('request.calculate');
    Route::get('/request/expose-metrics', 'Site\RequestController@exposeMetrics')
        ->middleware(['metric.basic.auth'])
        ->name('request.expose_metrics');

    Route::get('/request/images/{imageUrl}', 'Site\RequestController@images')
        ->where('imageUrl', '.*')
        ->name('request.images');
});

Route::get('/{languageUrl}/{pageUrl?}/{category?}/{question?}', 'Site\PageController@showPage')
    ->middleware(['clear.get', 'save.utm.to.cookies', 'antifraud', 'save.statistics',])
    ->where('category', '\d+')
    ->where('item', '\d+')
    ->name('site.support');

Route::get('/{languageUrl}/{pageUrl?}', 'Site\PageController@showPage')
    ->middleware(['clear.get', 'save.utm.to.cookies', 'antifraud', 'save.statistics'])
    ->where('pageUrl', '.*')
    ->name('site.show_page');
