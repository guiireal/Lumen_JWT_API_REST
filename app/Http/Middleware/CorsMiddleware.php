<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware {

    public function handle($request, Closure $next) {
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Controll-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Max-Age' => '86400',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With'
        ];

        if ($request->isMethod('OPTIONS'))
            return response()->json(['message' => 'The method is of type options'], 200, $headers);

        $response = $next($request);
        foreach ($headers as $key => $value)
            $response->header($key, $value);

        return $response;
    }

}
