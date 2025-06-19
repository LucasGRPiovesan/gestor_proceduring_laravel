<?php

namespace App\Application\UseCases\User;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\DTO\User\FetchUserDTO;
use App\Application\DTO\User\StoreUserDTO;
use App\Domain\Repositories\ProfileRepositoryInterface;
use App\Models\User;

class StoreUserUseCase
{
  public function __construct(
    private UserRepositoryInterface $userRepo,
    private ProfileRepositoryInterface $profileRepo
  ) {}

  /**
   * @return FetchUserDTO
   */
  public function execute(array $data): FetchUserDTO
  {
    $dto = StoreUserDTO::fromArray($data);
    
    // Validate that the profile exists
    $this->profileRepo->fetch($dto->uuid_profile);
    
    $user = $this->userRepo->store($dto);
    return FetchUserDTO::fromEntity($user);
  }
}