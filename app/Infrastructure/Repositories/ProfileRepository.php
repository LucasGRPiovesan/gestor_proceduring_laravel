<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTO\Profile\ListProfileDTO;
use App\Application\DTO\Profile\StoreProfileDTO;
use App\Application\DTO\Profile\UpdateProfileDTO;
use App\Models\Profile;
use App\Domain\Repositories\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
  public function __construct(){}

  public function list(): array
  {
    $query = Profile::orderBy('created_at', 'desc');

    ListProfileDTO::$total = $query->count();

    return $query
      ->skip((ListProfileDTO::$page - 1) * ListProfileDTO::$perPage)
      ->take(ListProfileDTO::$perPage)
      ->get()
      ->all();
  }

  public function fetch(string $uuid): ?Profile
  {
    return Profile::where('uuid', $uuid)->firstOrFail();
  }

  public function store(StoreProfileDTO $dto): Profile
  {
    return Profile::create([
      'profile' => $dto->profile,
      'description' => $dto->description,
    ]);
  }

  public function update(Profile $profile): Profile
  {
    $profile->save();
    return $profile;
  }

  public function delete(Profile $profile): void
  {
    $profile->delete();
  }
}