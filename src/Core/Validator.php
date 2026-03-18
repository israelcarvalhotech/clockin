<?php

namespace App\Core;

class Validator
{
    private array $errors = [];

    public function required(string $field, string $value, string $label): self
    {
        if (empty(trim($value))) {
            $this->errors[$field] = "{$label} é obrigatório.";
        }
        return $this;
    }

    public function email(string $field, string $value, string $label): self
    {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "{$label} inválido.";
        }
        return $this;
    }

    public function minLength(string $field, string $value, int $min, string $label): self
    {
        if (!empty($value) && strlen($value) < $min) {
            $this->errors[$field] = "{$label} deve ter no mínimo {$min} caracteres.";
        }
        return $this;
    }

    public function confirm(string $field, string $value, string $confirmation, string $label): self
    {
        if ($value !== $confirmation) {
            $this->errors[$field] = "{$label} não conferem.";
        }
        return $this;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getFirstError(): string
    {
        return reset($this->errors) ?: '';
    }
}