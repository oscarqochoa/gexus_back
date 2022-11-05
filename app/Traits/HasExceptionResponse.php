<?php

namespace App\Traits;

use Exception;

class HasExceptionResponse
{

    public static function exception(Exception $exception)
    {
        $message = $exception->getMessage();
        $code = $exception->getCode();

        return response($message, $code);
    }

}
