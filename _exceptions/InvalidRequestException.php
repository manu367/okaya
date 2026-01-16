<?php
//echo "hello bro"
class InvalidRequestException extends Exception
{
    public function __construct(
        $message = "Invalid request detected",
        $code = 400,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
?>