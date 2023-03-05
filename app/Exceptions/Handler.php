<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json(["res"=> false , "error"=> "Error de modelo"], 400);
        }

        if ($e instanceof QueryException) {
            return response()->json(["res"=> false , "error"=> "Error de consulta de la BD", $e->getMessage()], 400);
        }

        if ($e instanceof HttpException) {
            return response()->json(["res"=> false , "error"=> "Error de ruta"], 404);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json(["res"=> false , "error"=> "Error de autenticación"], 401);
        }

        if ($e instanceof AuthorizationException) {
            return response()->json(["res"=> false , "error"=> "Error de autorización, no tiene permisos"], 403);
        }

        return parent::render($request, $e);
    }
}
