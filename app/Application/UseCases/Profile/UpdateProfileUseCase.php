<?php

namespace App\Application\UseCases\Profile;

use App\Domain\Repositories\ProfileRepositoryInterface;
use App\Application\DTO\Profile\{FetchProfileDTO, UpdateProfileDTO};

class UpdateProfileUseCase
{
  public function __construct(private ProfileRepositoryInterface $profileRepo) {}

  public function execute(string $uuid, array $data): FetchProfileDTO
  {
    $profile = $this->profileRepo->fetch($uuid);

    $dto = UpdateProfileDTO::fromArray($data);
    $dto->applyTo($profile);

    $this->profileRepo->update($profile);

    return FetchProfileDTO::fromEntity($profile);
  }
}
