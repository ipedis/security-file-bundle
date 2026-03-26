<?php

declare(strict_types=1);

namespace Ipedis\SecurityFileBundle\Service\Validator;

use Ipedis\ValidationHandler\ConstraintFactory;
use Ipedis\ValidationHandler\Data\Constraints\ConstraintInterface;
use Ipedis\ValidationHandler\Data\DataWrapper;
use Ipedis\ValidationHandler\Data\DataWrapperInterface;
use Ipedis\ValidationHandler\Validator\Result\ValidationResult;
use ReflectionException;

class FileValidator implements FileValidatorInterface
{
    /**
     * @throws ReflectionException
     */
    /**
     * @param array<ConstraintInterface> $constraints
     */
    public function validate(DataWrapperInterface|\SplFileInfo $data, array $constraints): ValidationResult
    {
        if (! $data instanceof DataWrapperInterface) {
            $data = new DataWrapper($data);
        }

        /** @var ValidationResult $result */
        $result = ConstraintFactory::build($constraints)->handle($data);

        return $result;
    }
}
