<?php

namespace App\Exceptions;

use App\Traits\ApiResponses;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

//deprecated for laravel 11
class Handler extends ExceptionHandler
{
    use ApiResponses;
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
        $this->reportable(function (Throwable $e) {
            
        });
    }


    //comprehensive error handling
    public function render($request, Throwable $exception)
    {
        return $this->error([
            [
                'type' => get_class($exception),
                'status' => 0,
                'message' => $exception->getMessage(),
                'source' => 'Line' . $exception->getLine() . ": " . $exception->getFile(),
                'test' => "working error exception"
            ]
        ]);
    }
}
