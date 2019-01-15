<?php

namespace App\Constants;


class ResponseCode
{

    const INVALID_AUTHORIZATION = [
        'code' => 1000,
        'message' => 'Invalid authorization',
        'level' => 'info'
    ];

    const INVALID_AUTHORIZATION_UNCONFIRMED_EMAIL = [
        'code' => 1001,
        'message' => 'Email not verified yet',
        'level' => 'info'
    ];

    const MISSING_REQUIRED_PARAMETER = [
        'code' => 1002,
        'message' => 'Missing required parameters',
        'level' => 'info'
    ];

    const DATA_ALREADY_EXISTS = [
        'code' => 1003,
        'message' => 'Data already exists',
        'level' => 'info'
    ];

    const INTERNAL_SERVER_ERROR = [
        'code' => 1004,
        'message' => 'Something went wrong',
        'level' => 'error'
    ];

    const RESOURCE_NOT_FOUND = [
        'code' => 1005,
        'message' => 'Resource not found',
        'level' => 'info'
    ];

    const INVALID_REQUEST_METHOD = [
        'code' => 1006,
        'message' => 'Invalid request method',
        'level' => 'info'
    ];

}