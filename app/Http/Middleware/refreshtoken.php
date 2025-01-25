<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class refreshtoken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->token_expired_at < now()) {
            return response()->json([
                'message' => 'Unauthorized',
                'refresh_token' => $request->user()->refresh_token,
            ], 401);
        }

        $request->user()->regenerateToken();

        return $next($request);
    }
}
