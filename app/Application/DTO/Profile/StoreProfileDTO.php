<?php

namespace App\Application\DTO\Profile;

use InvalidArgumentException;

class StoreProfileDTO
{
    public string $profile;
    public ?string $description;

    public function __construct(string $profile, ?string $description = null)
    {
        $this->profile = $profile;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        if (empty($data['profile'])) {
            throw new InvalidArgumentException("profile is required.");
        }

        if (empty($data['description'])) {
            throw new InvalidArgumentException("description is required.");
        }

        return new self(
            $data['profile'],
            $data['description'] ?? null
        );
    }
}