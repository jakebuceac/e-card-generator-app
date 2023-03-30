<?php

namespace App\Exceptions;

use Exception;

class OpenAiException extends Exception
{
    /**
     * Failed to get the generated images.
     *
     * @return static
     */
    public static function couldNotGetGeneratedImages(): self
    {
        return new self('Could not get generated images', 500);
    }
}
