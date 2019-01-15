<?php

namespace App\Exceptions;


use App\Constants\HTTPStatus;
use App\Constants\ResponseCode;

class MissingRequiredParameterException extends RLCustomExceptionHandler
{

    public function __construct(\Throwable $previous = null)
    {
        $this->responseCode = ResponseCode::MISSING_REQUIRED_PARAMETER;
        $this->httpStatus = HTTPStatus::HTTP_UNPROCESSABLE_ENTITY;
        parent::__construct($previous);
    }

}