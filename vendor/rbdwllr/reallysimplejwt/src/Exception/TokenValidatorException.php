<?php namespace ReallySimpleJWT\Exception;

use Exception;

/**
 * Simple exception interface class for the Token Validator class to make
 * exceptions more specific and obvious. Extends the PHP exception class
 */
class TokenValidatorException extends Exception
{
    /**
     * Constructor for the Token Builder Exception class
     *
     * @param string $message
     * @param int $code
     * @param string $previous
     */
    public function __construct($message, $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
