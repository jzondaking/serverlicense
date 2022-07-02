<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class App
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
        $userInput = $request->all();
        array_walk_recursive($userInput, function (&$userInput) {
            $userInput = strip_tags($userInput);
        });
        $request->merge($userInput);

        if (empty(env('DB_DATABASE')) || empty(env('DB_USERNAME'))) {
            return response(view('setup'));
        }
        
        return $next($request);
    }
}
