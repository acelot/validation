<?php

namespace Acelot\Validation\Validator;

use Acelot\Validation\Validator;

class Regex extends Validator
{
    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var string
     */
    protected $template = 'Field must match the pattern "{pattern}"';

    /**
     * @param string $pattern
     */
    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @param string $value
     * @param array $wholeData
     * @return int
     */
    public function validate($value, $wholeData = null)
    {
        return preg_match($this->pattern, $value);
    }
}