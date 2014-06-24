<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class Email extends Validator
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