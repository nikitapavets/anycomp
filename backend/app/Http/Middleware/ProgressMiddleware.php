<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Repair;

class ProgressMiddleware
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
        $repair = new Repair();

        $token = $request->token ? $request->token : '';
        $repair = $repair->getRepairByToken($token);
        if($repair !== null){
            return $next($request);
        }else{
            return redirect()->route('repair');
        }
    }
}
