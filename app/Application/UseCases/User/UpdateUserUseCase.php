<?php

namespace App\Application\UseCases\User;

use App\Application\DTO\User\FetchUserDTO;
use App\Application\DTO\User\UpdateUserDTO;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Repositories\ProfileRepositoryInterface;

class UpdateUserUseCase
{
  public function __construct(
    private UserRepositoryInterface $userRepo,
    private ProfileRepositoryInterface $profileRepo
  ) {}

  public function execute(string $uuid, array $data): FetchUserDTO
  {
    $user = $this->userRepo->fetch($uuid);
    
    // Validate if profile exists
    if (in_array('uuid_profile', $data)) {
      $this->profileRepo->fetch($data['uuid_profile']);
    }

    $dto = UpdateUserDTO::fromArray($data);
    $dto->applyTo($user);

    $this->userRepo->update($user);
    return FetchUserDTO::fromEntity($user);
  }
}
