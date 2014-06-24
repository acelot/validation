<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class NotBlank extends Validator
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