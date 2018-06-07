<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param array $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if($request->user() === null){
            return response("No posee los permisos nescesarios",401);
        }

        if(!$roles || $request->user()->hasAnyRole($roles)){
            return $next($request);
        }
        return response("No posee los permisos nescesarios",401);
    }
}
