<?php


namespace floor12\DalliApi\Exceptions;

use ErrorException;

class EmptyTokenException extends ErrorException
{

   public function __construct($message = "", $code = 0, $severity = 1, $filename = __FILE__, $lineno = __LINE__, $previous = null)
   {
       parent::__construct('Dalli Service auth token is empty.', $code, $severity, $filename, $lineno, $previous);
   }
}
