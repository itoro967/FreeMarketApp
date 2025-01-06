<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSetProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guest() || (isset(Auth::user()->post_code))) {
            return $next($request);
        } else if ($request->path() == 'mypage/profile') {
            return $next($request);
        } else {
            return redirect('/mypage/profile')->with(['message' => 'プロフィールを設定してください']);
        }
    }
}
