<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNoApiKey
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('gameyeApiKey'))
        {
            // gameyeApiKey value can't be found in session
            
            return redirect('/config')
                -> with('status', 'Please fill in all the information');
        }

        return $next($request);
    }

}
