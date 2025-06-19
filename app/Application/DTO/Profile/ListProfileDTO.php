<?php

namespace App\Application\DTO\Profile;

use App\Models\Profile;

class ListProfileDTO
{
    public string $uuid;
    public string $profile;
    public string $description;
    public string $created_at;

    public static int $total;
    public static int $perPage;
    public static int $page;

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

    public static function fromMany(array $profiles): array
    {
      return [
        'data' => array_map(fn(Profile $profile) => self::fromEntity($profile), $profiles),
        'meta' => [
          'total' => self::$total,
          'perPage' => self::$perPage,
          'currentPage' => self::$page,
          'lastPage' => ceil(self::$total / self::$perPage),
        ]
      ];
    }
}