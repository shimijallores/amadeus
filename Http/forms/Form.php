<?php

namespace Http\Forms;

use Core\ValidationException;

class Form
{
    protected array $errors = [];
    public array $attributes = [];

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    public static function validate($attributes): null|static
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    /**
     * @throws ValidationException
     */
    public function throw(): void
    {
        ValidationException::throw($this->get_errors(), $this->attributes);
    }

    public function failed(): int
    {
        return count($this->errors);
    }

    public function get_errors(): array
    {
        return $this->errors;
    }

    public function error($field, $error): static
    {
        $this->errors[$field] = $error;

        return $this;
    }
}
