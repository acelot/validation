<?php

namespace Acelot\Validation;

use Acelot\Validation\Exception\ValidationException;
use Acelot\Validation\Exception\ValidationRequiredFieldMissingException;

class Validation
{
    /**
     * @var array
     */
    protected $rules;
    /**
     * @var array
     */
    protected $errors;

    public function __construct()
    {
        $this->rules = array();
    }

    /**
     * @param string $field
     * @param array $validators
     * @param boolean $stopOnFirst
     * @param boolean $required
     * @return $this
     */
    public function rule($field, $validators, $stopOnFirst = true, $required = false)
    {
        if ($validators instanceof IValidatable) {
            $validators = array($validators);
        }

        $this->rules[$field] = array(
            'validators'  => $validators,
            'stopOnFirst' => $stopOnFirst,
            'required'    => $required
        );

        return $this;
    }

    /**
     * @param string $field
     * @param array $validators
     * @param boolean $stopOnFirst
     * @return $this
     */
    public function requiredRule($field, $validators, $stopOnFirst = true)
    {
        $this->rule($field, $validators, $stopOnFirst, true);

        return $this;
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function validate($data)
    {
        $this->errors = array();
        $missingFields = array();

        foreach ($this->rules as $field => $rule) {
            /** @var $validator IValidatable */
            foreach ($rule['validators'] as $validator) {
                if (!isset($data[$field])) {
                    if ($rule['required']) {
                        $missingFields[] = $field;
                    }

                    break;
                } else {
                    if (!$validator->validate($data[$field], $data)) {
                        $this->addError($field, $validator);

                        // Stop validating field if $stopOnFirst set to true
                        if ($rule['stopOnFirst']) {
                            break;
                        }
                    }
                }
            }
        }

        if (count($missingFields)) {
            throw new ValidationRequiredFieldMissingException($this, $missingFields);
        }

        if (count($this->errors)) {
            $this->throwException();
        }
    }

    /**
     * @throws Exception\ValidationException
     */
    public function throwException()
    {
        throw new ValidationException($this);
    }

    /**
     * @param array $messages
     * @return array
     */
    public function getErrors(array $messages = array())
    {
        $messageKeys = array_keys($messages);
        $output = array();

        foreach ($this->errors as $field => $errors) {
            $output[$field] = array();

            foreach ($errors as $error) {
                if ($error instanceof IValidatable) {
                    $classFullName = get_class($error);
                    $parts = explode('\\', $classFullName);
                    $classShortName = end($parts);

                    $keyVariants = array(
                        $field . '::' . $classFullName,
                        $field . '::' . $classShortName,
                        $classFullName,
                        $classShortName
                    );

                    $matchedKeys = array_intersect($keyVariants, $messageKeys);
                    $template = current($matchedKeys) ? $messages[current($matchedKeys)] : null;

                    array_push($output[$field], $error->getMessage($template));
                } else {
                    array_push($output[$field], $error);
                }
            }
        }

        return $output;
    }

    /**
     * @param string $field
     * @param string|IValidatable $error
     * @return $this
     */
    public function addError($field, $error)
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = array();
        }

        array_push($this->errors[$field], $error);

        return $this;
    }

    /**
     * @param string $errorMessage
     * @param string $key
     * @return $this
     */
    public function addCustomError($errorMessage, $key = 'custom')
    {
        $this->addError($key, $errorMessage);

        return $this;
    }
}