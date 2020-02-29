<?php

namespace App\Http\Middleware;

use Closure;

class CheckDeng
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
        $user=session('loginuser');
        if(!$user){
            return redirect('/deng');
        }
        return $next($request);
    }
}
