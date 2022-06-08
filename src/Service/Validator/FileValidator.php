<?php

namespace Ipedis\SecurityFileBundle\Service\Validator;

use Ipedis\ValidationHandler\ConstraintFactory;
use Ipedis\ValidationHandler\Data\DataWrapper;
use Ipedis\ValidationHandler\Data\DataWrapperInterface;
use Ipedis\ValidationHandler\Validator\Result\ValidationResult;
use SplFileInfo;

class FileValidator implements FileValidatorInterface
{
    public function validate(DataWrapperInterface|SplFileInfo $data, array $constraints): ValidationResult
    {
        if (!$data instanceof DataWrapperInterface) {
            $data = new DataWrapper($data);
        }
        return ConstraintFactory::build($constraints)->handle($data);
    }
}
