<?php

namespace Ipedis\SecurityFileBundle\Exception;

use \Exception;

class InvalidEngineTypeException extends Exception
{
    public function __construct(string $type, int $code = 0)
    {
        parent::__construct(sprintf("$type is not a valid engine type"), $code);
    }

}
