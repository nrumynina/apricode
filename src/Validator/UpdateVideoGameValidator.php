<?php

declare(strict_types=1);

namespace App\Validator;

class UpdateVideoGameValidator implements ValidatorInterface
{
    private array $errors = [];

    public function isValid(array $data): bool
    {
        $isValid = true;

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
