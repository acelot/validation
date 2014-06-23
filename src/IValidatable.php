<?php

namespace Acelot\Validation;

interface IValidatable
{
    /**
     * @return boolean
     */
    public function validate($value, $wholeData = null);

    /**
     * @return string
     */
    public function getMessage($template = null);
}