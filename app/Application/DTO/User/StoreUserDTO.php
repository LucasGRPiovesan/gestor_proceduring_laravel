<?php

namespace App\Application\DTO\User;

use InvalidArgumentException;

class StoreUserDTO
{
    public string $uuid_profile;
    public string $name;
    public string $email;
    public string $password;

    public function __construct(
        string $uuid_profile,
        string $name,
        string $email,
        string $password
    ) {
        $this->uuid_profile = $uuid_profile;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function fromArray(array $data): self
    {
        if (empty($data['uuid_profile'])) {
            throw new InvalidArgumentException("uuid_profile is required.");
        }

        if (empty($data['name'])) {
            throw new InvalidArgumentException("name is required.");
        }

        if (empty($data['email'])) {
            throw new InvalidArgumentException("email is required.");
        }

        if (empty($data['password'])) {
            throw new InvalidArgumentException("password is required.");
        }

        return new self(
            $data['uuid_profile'],
            $data['name'],
            $data['email'],
            $data['password']
        );
    }
}