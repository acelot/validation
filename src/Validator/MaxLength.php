<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class MaxLength extends Validator
{
    /**
     * @var int
     */
    protected $maxLength;

    /**
     * @var string
     */
    protected $template = 'Field must be longer than {maxLength} characters';

    /**
     * @param int $maxLength
     */
    public function __construct($maxLength) {
        $this->maxLength = $maxLength;
    }

    /**
     * @param string $value
     * @param array $wholeData
     * @return bool
     */
    public function validate($value, $wholeData = null)
    {
        return strlen($value) <= $this->maxLength;
    }
}