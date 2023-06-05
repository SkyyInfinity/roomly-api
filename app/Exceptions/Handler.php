<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        // On modifier le comportement pour l'exception NotFoundHttpException
        $this->renderable(function (NotFoundHttpException $e, $request) {
            // If request contain "api/*"
            if ($request->is("api/*")) {
                // Return 404 error response in JSON format
                return response()->json([
                    "message" => "La ressource est introuvable."
                ], 404);
            }
        });
    }
}
