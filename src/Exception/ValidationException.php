<?php

namespace Acelot\Validation\Exception;

use Acelot\Validation\Validation;

class ValidationException extends \Exception {

    /**
     * @var \Acelot\Validation\Validation
     */
    protected $validation;

    /**
     * @param Validation $validation
     */
    public function __construct(Validation $validation)
    {
        $this->validation = $validation;
    }

    /**
     * @param array $messages
     * @return array
     */
    public function getErrors($messages = array())
    {
        return $this->validation->getErrors($messages);
    }
}