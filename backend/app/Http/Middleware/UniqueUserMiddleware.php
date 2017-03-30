<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Users\UniqueUser;

class UniqueUserMiddleware
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
	    if(!strstr($_SERVER['HTTP_USER_AGENT'], 'Yandex') && !strstr($_SERVER['HTTP_USER_AGENT'], 'Google'))
	    {
		    if(!UniqueUser::isRegistered())
		    {
			    UniqueUser::initUniqueUser();
		    }
	    }

        return $next($request);
    }
}
