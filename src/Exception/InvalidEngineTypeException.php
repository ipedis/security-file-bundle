<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\Exception;

class InvalidEngineTypeException extends \Exception
{
    public function __construct(string $type, int $code = 0)
    {
        parent::__construct($type . ' is not a valid engine type', $code);
    }
}
