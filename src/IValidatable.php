<?php

namespace Acelot\Validation;

interface IValidatable
{
    /**
     * @param mixed $value
     * @param array $wholeData
     * @return bool
     */
    public function validate($value, $wholeData = null);

    /**
     * @param string $template
     * @return string
     */
    public function getMessage($template = null);
}