<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomRender
{
    
    public function handleValidation(ValidationException $exception)
    {

        foreach ($exception->errors() as $key => $value) {
            foreach ($value as $message) {
                $individualError[] = [
                    'status' => 422,
                    'message' => $message,
                    'source' => $key
                ];
            }
        }

        return $individualError;
    }

    public function handleModelNotFoundFound(NotFoundHttpException $exception)
    {
        return [
            [
                'status' => 404,
                'message' => "Resource doesn't found",
                // 'source' => $exception->getModel()    
            ]
        ];
    }

    public function handleAccesssDenied(AccessDeniedHttpException $exception)
    {
        return [
            [
                'status' => 404,
                'message' => "You're not authorized to this action",
                'source' => ''  
            ]
        ];
    }

public function handleAuthentication(AuthenticationException $exception) {
    return [
        [
            'status' => 404,
            'message' => "You're not authorized to this action",
            'source' => ''  
        ]
    ];
}


/**
 * This function is resolving which
 * error is occured to their respective functions
 */
    public function exceptionRender($exception)
    {

        $responseHandler = new ErrorResponseHandler();
        $className = get_class($exception);
        $index = strrpos($className, '\\');
        $plainClassName = substr($className, $index + 1);

        if (array_key_exists($className, $responseHandler->handlers)) {
            $method = $responseHandler->handlers[$className];
            return $responseHandler->error($this->$method($exception));
        }



        //DEFAULT ---- if none of the method cant respond
        return $responseHandler->error([
            'type' => $plainClassName,
            'status' => 0,
            'message' => $exception->getMessage(),
            'source' => 'Line No: ' . $exception->getLine() . "   ***** File Name: " . $exception->getFile(),
            'from' => 'default'
        ], 400);
    }
}