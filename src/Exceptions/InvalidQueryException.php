<?php

namespace Mihaib\PortalJustService\Exceptions;

use Exception;
use Throwable;

class InvalidQueryException extends Exception
{
    public function __construct(
        string $message = "Invalid query!",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
