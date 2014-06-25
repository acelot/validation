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
     * Example:
     * $rules = array(
     *     'field1' => array(
     *         'validators' => array(
     *             new NotBlank(),
     *             new Integer()
     *         ),
     *         'required' => true
     *     ),
     *     'field2' => array(
     *         'validators' => array(
     *             new NotBlank(),
     *             new Regex('/[a-z]+/')
     *         ),
     *         'strict'     => false
     *     ),
     * )
     *
     * Defaults:
     *     strict = true;
     *     required = false;
     *
     * @param array $rules Rules (see example above)
     */
    public function setRules(array $rules)
    {
        foreach ($rules as $field => $rule) {
            $rule = array_merge(
                array(
                    'strict'   => true,
                    'required' => false
                ),
                $rule
            );

            $this->rule($field, $rule['validators'], $rule['strict'], $rule['required']);
        }

        return $this;
    }

    /**
     * @param string $field Field name
     * @param array $validators Array of validators
     * @param boolean $strict Stop validating field on first error
     * @param boolean $required Is field required
     * @return $this
     */
    public function rule($field, $validators, $required = false, $strict = true)
    {
        if ($validators instanceof IValidatable) {
            $validators = array($validators);
        }

        $this->rules[$field] = array(
            'validators' => $validators,
            'strict'     => $strict,
            'required'   => $required
        );

        return $this;
    }

    /**
     * @param string $field Field name
     * @param array $validators Array of validators
     * @param boolean $strict Stop validating field on first error
     * @return $this
     */
    public function requiredRule($field, $validators, $strict = true)
    {
        $this->rule($field, $validators, true, $strict);

        return $this;
    }

    /**
     * @param  array $data Validating array
     * @throws Exception\ValidationRequiredFieldMissingException
     * @throws Exception\ValidationException
     */
    public function validate(array $data)
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
                        if ($rule['strict']) {
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
     * Output:
     * array(
     *     'field1' => array('message1', 'message2'),
     *     'field2' => array('message1', 'message2'),
     * )
     *
     * @param  array $messages Array of message templates
     * @return array Rendered messages
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