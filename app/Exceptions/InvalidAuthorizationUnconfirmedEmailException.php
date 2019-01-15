<?php

namespace App\Exceptions;


use App\Constants\HTTPStatus;
use App\Constants\ResponseCode;

class InvalidAuthorizationUnconfirmedEmailException extends RLCustomExceptionHandler
{

    public function __construct(\Throwable $previous = null)
    {
        $this->responseCode = ResponseCode::INVALID_AUTHORIZATION_UNCONFIRMED_EMAIL;
        $this->httpStatus = HTTPStatus::HTTP_FORBIDDEN;
        parent::__construct($previous);
    }

}