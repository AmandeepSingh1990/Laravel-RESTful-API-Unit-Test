<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
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
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $data = ['message'=>null,'data'=>[]];
        if($exception instanceof ValidationException){
            $data['message'] = "Validation Error";
            $data['data'] = $exception->errors();
            return response()->json($data,422);
        }
        elseif($exception instanceof ModelNotFoundException){
            $data['message'] = $exception->getModel().' Not Found';
            return response()->json($data,404);
        }elseif($exception instanceof AuthenticationException){
            $data['message'] = $exception->getMessage();
            return response()->json($data,401);
        }else{
            $data['message'] = $exception->getMessage()." On Line ".$exception->getLine()." In ".$exception->getFile();
            return response()->json($data,400);
        }
        return parent::render($request, $exception);
    }
}
