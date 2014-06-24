<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\IValidatable;
use Acelot\Validation\AbstractValidator;

class NotBlank extends AbstractValidator implements IValidatable
{
    /**
     * @var string
     */
    protected $template = 'The field can not be empty';

    /**
     * @param string $value
     * @param array $wholeData
     * @return bool
     */
    public function validate($value, $wholeData = null)
    {
        return strlen($value) > 0;
    }
}