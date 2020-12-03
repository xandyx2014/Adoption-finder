<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permiso)
    {
        $user = auth()->user()->rol->permiso;
        $rol = auth()->user()->rol->nombre;
        if($rol == 'admin')
        {
            return $next($request);
        }
        // $user = User::findOrFail(1)->rol->permiso;
        if($user->pluck('nombre')->contains($permiso))
        {
            return $next($request);
        }
        return redirect('home');
    }
}
