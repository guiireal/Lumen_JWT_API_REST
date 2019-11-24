<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Authenticate {


    public function handle($request, Closure $next, $guard = null) {
        try {
            $user = Auth::payload();
        } catch (TokenExpiredException $error) {
            return response()->json(['expired_token' => $error->getMessage()], 500);
        } catch (TokenInvalidException $error) {
            return response()->json(['invalid_token' => $error->getMessage()], 500);
        } catch (JWTException $error) {
            return response()->json(['missing_token' => $error->getMessage()], 500);
        }

        return $next($request);
    }
}
