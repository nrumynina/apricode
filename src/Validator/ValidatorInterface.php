<?php

namespace App\Validator;

interface ValidatorInterface
{
    public function isValid(array $data): bool;

    public function getErrors(): array;
}
