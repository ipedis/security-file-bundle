<?php

namespace Ipedis\SecurityFileBundle\Service\Validator;

use Ipedis\ValidationHandler\ConstraintFactory;
use Ipedis\ValidationHandler\Data\DataWrapperInterface;
use Ipedis\ValidationHandler\Handler\HandlerInterface;
use Ipedis\ValidationHandler\Validator\Result\ValidationResult;

abstract class ValidatorAbstract
{
    protected HandlerInterface $handler;

    public function __construct()
    {
        $this->handler = ConstraintFactory::build($this->registeredConstraints());
    }

    public function handle(DataWrapperInterface $dataWrapper): ValidationResult
    {
        return $this->handler->handle($dataWrapper);
    }

    protected abstract function registeredConstraints(): array;

}
