<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization')) {
            $key = explode(' ', $request->header('Authorization'));
            $check = User::where('token', $key[1])->first();

            if (!$check) {
                return response()->json(['success' => true, 'message' => 'token tidak valid', 'code' => 401]);
            } else {
                return $next($request);
            }
        } else {
            return response()->json(['success' => true, 'message' => 'token tidak valid', 'code' => 401]);
        }
    }
}
