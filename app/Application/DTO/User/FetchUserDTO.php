<?php

namespace App\Application\DTO\User;

use App\Models\{Profile, User};

class FetchUserDTO
{
    public string $uuid;
    public string $name;
    public string $email;
    public array $profile;
    public string $created_at;

    public function __construct(
      string $uuid,
      string $name,
      string $email,
      Profile $profile,
      string $created_at
    ) {
      $this->uuid = $uuid;
      $this->name = $name;
      $this->email = $email;
      $this->profile = [
        "uuid" => $profile->uuid,
        "profile" => $profile->profile,
      ];
      $this->created_at = $created_at;
    }

  public static function fromEntity(User $user): self
  {
    return new self(
      $user->uuid,
      $user->name,
      $user->email,
      $user->profile,
      $user->created_at->format('Y-m-d H:i:s')
    );
  }
}