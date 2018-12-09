<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 24/11/18
 * Time: 13.55
 */

namespace App\Exceptions;


class RLCustomExceptionHandler extends \Exception
{


    public $responseCode = [
        'code' => 0,
        'message' => '',
        'level' => null
    ];

    public $httpStatus = 200;

    public function __construct(\Throwable $previous = null)
    {
        parent::__construct($this->responseCode['message'], $this->responseCode['code'], $previous);
    }

}