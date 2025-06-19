<?php

namespace App\Application\DTO\User;

use App\Models\User;
use InvalidArgumentException;

class UpdateUserDTO
{
  private array $fields = [];
  private const ALLOWED_FIELDS = ['uuid_profile', 'name', 'email'];

  private function __construct(array $fields)
  {
    $this->fields = $fields;
  }

  public static function fromArray(array $data): self
  {
    $filtered = [];

    foreach ($data as $key => $value) {
      if (!in_array($key, self::ALLOWED_FIELDS, true)) {
        throw new InvalidArgumentException("Campo '{$key}' não é permitido para atualização.");
      }

      if ($value === null || $value === '') {
        continue;
      }

      $filtered[$key] = $value;
    }

    if (empty($filtered)) {
      throw new InvalidArgumentException("Nenhum campo válido foi informado para atualização.");
    }

    return new self($filtered);
  }

  public function applyTo(User $user): void
  {
    foreach ($this->fields as $key => $value) {
      $user->{$key} = $value;
    }
  }
}
