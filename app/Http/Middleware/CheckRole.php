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
            //return response("<div class='alert alert-danger'>No posee los permisos nescesarios</div>",401);
            //response()->withErrors(['msg', 'No posee los permisos necesarios']);
            return redirect()->back()->withErrors(['Ingreso inesperado', 'No posee los permisos necesarios']);
        }

        if(!$roles || $request->user()->hasAnyRole($roles)){
            return $next($request);
        }
        //response()->withErrors(['msg', 'No posee los permisos necesarios']);
        //return response("<div class='alert alert-danger'>No posee los permisos nescesarios</div>",401);
        return redirect()->back()->withErrors(['Ingreso inesperado', 'No posee los permisos necesarios']);
    }
}
