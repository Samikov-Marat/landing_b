<?php

namespace App\Http;

use App\Http\Middleware\Antifraud;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckForMaintenanceMode;
use App\Http\Middleware\ClearGet;
use App\Http\Middleware\DebugbarDisable;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\HttpSecure;
use App\Http\Middleware\LocalOfficeBelongToSite;
use App\Http\Middleware\MetricBasicAuth;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SaveStatistics;
use App\Http\Middleware\SaveUtmToCookies;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\UserRouteAccess;
use App\Http\Middleware\VelocityBasicAuth;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\VerifyRecaptchaToken;
use Fruitcake\Cors\HandleCors;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
//            \Illuminate\Session\Middleware\StartSession::class,
//            \Illuminate\Session\Middleware\AuthenticateSession::class,
//            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//            \App\Http\Middleware\VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'metric.basic.auth' => MetricBasicAuth::class,
        'velocity.basic.auth' => VelocityBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'verified' => EnsureEmailIsVerified::class,
        'user.route.access' => UserRouteAccess::class,
        'clear.get' => ClearGet::class,
        'save.utm.to.cookies' => SaveUtmToCookies::class,
        'antifraud' => Antifraud::class,
        'http.secure' => HttpSecure::class,
        'verify.csrf.token' => VerifyCsrfToken::class,
        'verify.recaptcha.token' => VerifyRecaptchaToken::class,
        'save.statistics' => SaveStatistics::class,
        'start.session' => StartSession::class,
        'share.errors.from.session' => ShareErrorsFromSession::class,
        'debugbar.disable' => DebugbarDisable::class,
//        \Illuminate\Session\Middleware\AuthenticateSession::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        StartSession::class,
        ShareErrorsFromSession::class,
        Authenticate::class,
        UserRouteAccess::class,
        VerifyCsrfToken::class,
        ClearGet::class,
        SaveUtmToCookies::class,
    ];
}
