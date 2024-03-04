<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EnsureManager
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
        $team = $request->route('team');
        $manager = $team->members()->where(['user_id' => $request->user()->id, 'role' => 1])->first();

        if (!$manager) {
            return redirect('/')->with('danger', 'アクセスできません');
        }

        return $next($request);
    }
}
