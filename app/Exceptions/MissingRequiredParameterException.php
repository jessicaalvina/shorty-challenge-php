<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 24/11/18
 * Time: 13.32
 */

namespace App\Exceptions;


use App\Libraries\HTTPStatus;
use App\Libraries\ResponseCode;

class MissingRequiredParameterException extends RLCustomExceptionHandler
{

    public function __construct(\Throwable $previous = null)
    {
        $this->responseCode = ResponseCode::MISSING_REQUIRED_PARAMETER;
        $this->httpStatus = HTTPStatus::HTTP_UNPROCESSABLE_ENTITY;
        parent::__construct($previous);
    }

}