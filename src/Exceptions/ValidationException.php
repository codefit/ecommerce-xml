<?php

namespace Feeds\XmlGenerator\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
} 