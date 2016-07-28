<?php

namespace App\Http\Middleware;

use Closure;
use \Firebase\JWT\JWT;

class JwtAuthenticate
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
        try {
            $header = $request->header('Authorization');
            if (empty($header)) {
                throw new \Exception("Authorization fail", 1);
            }
            $jwt = substr($header, 7);
            $key = env('JWT_KEY');
            $userinfo = JWT::decode($jwt, $key, array('HS256'));
            if (empty($userinfo->uid)) {
                throw new \Exception("Authorization fail", 1);
            }
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
        }

        $request->username = $userinfo->uid;

        return $next($request);
    }
}
