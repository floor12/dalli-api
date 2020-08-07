<?php


namespace floor12\DalliApi\Exceptions;

use ErrorException;

class EmptyApiMethodException extends ErrorException
{

    public function __construct($message = "", $code = 0, $severity = 1, $filename = __FILE__, $lineno = __LINE__, $previous = null)
    {
        parent::__construct('Dalli Service API method name is empty.', $code, $severity, $filename, $lineno, $previous);
    }
}
