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
        /*
         * If value is blank return true.
         * Use NotBlank before Regex to avoid this behavior.
         */
        if (strlen($value) === 0) {
            return true;
        }

        return preg_match($this->pattern, $value);
    }
}