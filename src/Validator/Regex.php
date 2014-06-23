<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class Regex extends Validator
{
    protected $pattern;
    protected $template = 'Field must match the pattern "{pattern}"';

    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null)
    {
        return preg_match($this->pattern, $value);
    }
}