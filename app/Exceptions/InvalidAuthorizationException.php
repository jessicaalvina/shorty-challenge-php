<?php

namespace App\Exceptions;


use App\Constants\HTTPStatus;
use App\Constants\ResponseCode;

class InvalidAuthorizationException extends RLCustomExceptionHandler
{

    public function __construct(\Throwable $previous = null)
    {
        $this->responseCode = ResponseCode::INVALID_AUTHORIZATION;
        $this->httpStatus = HTTPStatus::HTTP_FORBIDDEN;
        parent::__construct($previous);
    }

}