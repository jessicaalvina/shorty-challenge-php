<?php

namespace App\Exceptions;

use App\Libraries\HTTPStatus;
use App\Libraries\ResponseCode;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     * @throws Exception
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        $responseData = ResponseCode::INTERNAL_SERVER_ERROR;
        $httpStatus = HTTPStatus::HTTP_INTERNAL_SERVER_ERROR;

        if ($e instanceof NotFoundHttpException) {
            $responseData = ResponseCode::RESOURCE_NOT_FOUND;
            $httpStatus = HTTPStatus::HTTP_NOT_FOUND;
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            $responseData = ResponseCode::INVALID_REQUEST_METHOD;
            $httpStatus = HTTPStatus::HTTP_NOT_FOUND;
        }

        if ($e instanceof RLCustomExceptionHandler) {
            $responseData = $e->responseCode;
            $httpStatus = $e->httpStatus;
        } else if (env('APP_ENV') !== 'production') {
            $responseData['message_detail'] = [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
                'trace_string' => $e->getTraceAsString(),
            ];
        }

        $name = env('APP_NAME');
        $name = explode('-', $name);
        $name = end($name);

        \Rollbar::init(
            [
                'access_token' => env('ROLLBAR_TOKEN'),
                'environment' => $name
            ]
        );

        if ($e->responseCode['level'] === 'info') {
            \Rollbar::report_message($e->getMessage(), \Level::INFO, $request->all(), $e);
        } else {
            \Rollbar::report_exception($e, $request->all());
        }

        return response()->json($responseData, $httpStatus);

    }
}
