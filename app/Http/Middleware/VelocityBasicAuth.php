<?php

namespace App\Http\Middleware;

use App\ApiUser;
use Closure;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VelocityBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            $apiUser = ApiUser::where('name', $request->getUser())
                ->firstOrFail();
            if (!Hash::check($request->getPassword(), $apiUser->password)) {
                throw new Exception('Неверный пароль');
            }
            return $next($request);
        } catch (Exception $e) {
            Log::warning($e->getMessage());
        }
        return response()
            ->noContent()
            ->setStatusCode(Response::HTTP_FORBIDDEN);
    }
}
