<?php
namespace App\Common;

use PhalApi\Exception;

class ResultException extends Exception {

    public function __construct($message, $code = 0) {
        parent::__construct(
            \PhalApi\T('{message}', array('message' => $message)), 400 + $code
        );
    }
}