<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use Closure;
use Illuminate\Http\Request;

class StatisticsCheck
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
        $response =  $next($request);

        if (auth()->user()) {
            Activity::create([
                'urladdress' => request()->fullUrl(),
                'user_id' => auth()->user()->id,
            ]);
        }

        return $response;
    }
}
