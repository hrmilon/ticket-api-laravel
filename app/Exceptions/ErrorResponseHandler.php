<?php

namespace App\Exceptions;

use App\Traits\ApiResponses;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ErrorResponseHandler
{
    use ApiResponses;
    public $handlers = [
        ValidationException::class => 'handleValidation',
        NotFoundHttpException::class => 'handleModelNotFoundFound',
        AccessDeniedHttpException::class => 'handleAccesssDenied',
        AuthenticationException::class => 'handleAuthentication'
        
    ];
}