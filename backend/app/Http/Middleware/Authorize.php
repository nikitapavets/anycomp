<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Middleware;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class Authorize extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
        try {
            $this->authenticate($request);
            $response = $next($request);
        } catch (UnauthorizedHttpException $e) {
            $newToken = $this->auth->parseToken()->refresh();
            $this->auth->parseToken()->authenticate();

            // set the new token to the response headers
            $response = $next($request);
            $response->headers->set('Access-Control-Expose-Headers', 'Authorization');
            $response->headers->set('Authorization', 'Bearer ' . $newToken);
        } catch (JWTException $e) {
            return response()->error('token_invalid', $e->getStatusCode());
        }

        return $response;
    }
}
