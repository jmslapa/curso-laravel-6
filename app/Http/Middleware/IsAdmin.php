<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        $user = auth()->user();
        if(!in_array($user->email, [
            'lapeta96@gmail.com', 
            'admin@admin',
        ])) {
            return redirect('/');
        }
        return $next($request);
    }
}
