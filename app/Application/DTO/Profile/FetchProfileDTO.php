<?php

namespace App\Application\DTO\Profile;

use App\Models\Profile;

class FetchProfileDTO
{
    public string $uuid;
    public string $profile;
    public string $description;
    public string $created_at;

    public function __construct(
      string $uuid,
      string $profile,
      string $description,
      string $created_at
    ) {
      $this->uuid = $uuid;
      $this->profile = $profile;
      $this->description = $description;
      $this->created_at = $created_at;
    }

  public static function fromEntity(Profile $profile): self
  {
    return new self(
      $profile->uuid,
      $profile->profile,
      $profile->description,
      $profile->created_at->format('Y-m-d H:i:s')
    );
  }
}