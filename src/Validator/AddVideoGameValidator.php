<?php

declare(strict_types=1);

namespace App\Validator;

class AddVideoGameValidator implements ValidatorInterface
{
    private array $errors = [];

    public function isValid(array $data): bool
    {
        $isValid = true;

        if (!isset($data['name'])) {
            $this->errors[] = 'field "name" expected';
            $isValid = false;
        }

        if (!isset($data['developer'])) {
            $this->errors[] = 'field "developer" expected';
            $isValid = false;
        }

        if (isset($data['genres']) && !is_array($data['genres'])) {
            $this->errors[] = 'field "genres" must be array';
            $isValid = false;
        }

        return $isValid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
