<?php

namespace App\Http\Middleware;

use Closure;

class apiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authToken = $request->header()['authtoken'] ?? null;
        if (!$authToken) {
            return response()->json(['msg' => 'No token provided'], 403);
        } else {
            // dd($authToken, env('SECRET_KEY'));
            if ($authToken[0] != env('SECRET_KEY')) {
                return response()->json(['msg' => 'Invalid token'], 403);
            }

            return $next($request);
        }
    }
}
