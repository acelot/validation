Validation
==========

Validation utility for PHP5

## Key features

- Exception based validation, ie validate() method throws special exception on error and not return `false` or `true`
- Flexible system to receive error messages
- Have built-in common validators (`NotBlank`, `Email`, `Regex` etc)
- PSR-4 compliant code structure
- Available in Composer

## Usage

```php
$validation = new Validation();

$validation
    ->requiredRule(
        'email',
        array(
            new NotBlank(),
            new Email()
        )
    )
    ->requiredRule(
        'password',
        array(
            new NotBlank()
        )
    );
try {
    // You can pass any array to validate
    $validation->validate($_POST);

    // In this place all data is right. Make something!
} catch (ValidationRequiredFieldMissingException $e) {
    // Some required data is missing. For example, you can send status "400 Bad request"
} catch (ValidationException $e) {
    $errors = $e->getErrors(
        array(
            // Individual message for blank email field
            'email::NotBlank'    => 'Please, input E-mail',

            // Individual message for blank password field
            'password::NotBlank' => 'Please. input password',

            // Global message for Email validator
            'Email'              => 'Invalid E-mail'
        )
    );
}
```