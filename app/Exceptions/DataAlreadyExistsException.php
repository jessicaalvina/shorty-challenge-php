<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 24/11/18
 * Time: 13.32
 */

namespace App\Exceptions;


use App\Constants\HTTPStatus;
use App\Constants\ResponseCode;

class DataAlreadyExistsException extends RLCustomExceptionHandler
{

    public function __construct(\Throwable $previous = null)
    {
        $this->responseCode = ResponseCode::DATA_ALREADY_EXISTS;
        $this->httpStatus = HTTPStatus::HTTP_CONFLICT;
        parent::__construct($previous);
    }

}