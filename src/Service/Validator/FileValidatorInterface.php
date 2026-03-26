<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\Service\Validator;

use Ipedis\ValidationHandler\Data\Constraints\ConstraintInterface;
use Ipedis\ValidationHandler\Data\DataWrapperInterface;
use Ipedis\ValidationHandler\Validator\Result\ValidationResult;

interface FileValidatorInterface
{
    /**
     * @param array<ConstraintInterface> $constraints
     */
    public function validate(\SplFileInfo|DataWrapperInterface $data, array $constraints): ValidationResult;
}
