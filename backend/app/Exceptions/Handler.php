<?php

namespace App\Exceptions;

use App\Providers\ResponseServiceProvider;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param ValidationException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json($exception->errors(), $exception->status);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        switch ($exception) {
            case ($exception instanceof AuthorizationException):
            {
                return response()->error(
                    'You don\'t have permission to do this',
                    ResponseServiceProvider::HTTP_RESPONSE_FORBIDDEN
                );
                break;
            }
            case ($exception instanceof JWTException):
            {
                return response()->error(
                    'Token is invalid',
                    ResponseServiceProvider::HTTP_RESPONSE_UNAUTHORIZED
                );
                break;
            }
            case ($exception instanceof ModelNotFoundException):
            {
                return response()->error(
                    'The requested resource was not found',
                    ResponseServiceProvider::HTTP_RESPONSE_NOT_FOUND
                );
                break;
            }
            case ($exception instanceof NotFoundHttpException):
            {
                return response()->error(
                    'The requested resource was not found',
                    ResponseServiceProvider::HTTP_RESPONSE_NOT_FOUND
                );
            }
            case ($exception instanceof TokenExpiredException):
            {
                return response()->error(
                    'token_expired',
                    ResponseServiceProvider::HTTP_RESPONSE_UNAUTHORIZED
                );
            }
            case ($exception instanceof ValidationException):
            {
                return response()->error(
                    $exception->getResponse()->original,
                    ResponseServiceProvider::HTTP_RESPONSE_BAD_REQUEST
                );
                break;
            }
            default:
            {
                if (config('app.debug')) {
                    return parent::render($request, $exception);
                }
                return response()->error(
                    'Whoops, something went wrong',
                    ResponseServiceProvider::HTTP_RESPONSE_SERVER_ERROR
                );
                break;
            }
        };
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(
                ['error' => 'Unauthenticated.'],
                ResponseServiceProvider::HTTP_RESPONSE_FORBIDDEN);
        }

        return redirect()->guest(route('login'));
    }
}
