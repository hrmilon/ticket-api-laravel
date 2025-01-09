<?

//// bootstrap/app.php::render()
//handling exceptions

$responseHandler = new ErrorResponseHandler();
$className = get_class($exception);
$index = strrpos($className, '\\');
$plainClassName = substr($className, $index + 1);

// model based error
if ($className == ValidationException::class) {
    foreach ($exception->errors() as $key => $value) {
        foreach ($value as $message) {
            $individualError[] = [
                'status' => 422,
                'message' => $message,
                'source' => $key
            ];
        }
    }
    return $responseHandler->error($individualError);
}


//for general error
return $responseHandler->error([
    'type' => $plainClassName,
    'status' => 0,
    'message' => $exception->getMessage(),
    'source' => 'Line' . $exception->getLine() . ": File Name:::: " . $exception->getFile(),
], 400);



// AuthorsController::index()

return UserResource::collection(
    User::select('users.*')
        ->join('tickets', 'users_id', '=', 'ticktes.user_id')
        ->filter($filters)
        ->distinct()
        ->paginate()
);
