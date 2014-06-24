<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\IValidatable;
use Acelot\Validation\AbstractValidator;

class Email extends AbstractValidator implements IValidatable
{
    /**
     * @var string
     */
    protected $template = 'Invalid email';

    /**
     * @param string $value
     * @param array $wholeData
     * @return mixed
     */
    public function validate($value, $wholeData = null)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}