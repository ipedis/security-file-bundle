<?php

namespace Ipedis\SecurityFileBundle\Service\Validator;

use Ipedis\ValidationHandler\Data\DataWrapperInterface;
use Ipedis\ValidationHandler\Validator\Result\ValidationResult;
use SplFileInfo;

interface FileValidatorInterface
{
    public function validate(SplFileInfo|DataWrapperInterface $data, array $constraints): ValidationResult;

}
