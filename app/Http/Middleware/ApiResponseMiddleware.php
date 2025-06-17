<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\ApiResponse;

class ApiResponseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $original = $response->getData(true);

            if (isset($original['success'])) {
                return $response;
            }

            if (isset($original['data']) && isset($original['meta'])) {
                return ApiResponse::success($original['data'], 'Paginated Data');
            }

            return ApiResponse::success($original);
        }

        return $response;
    }
}
