<?php

namespace App\Application\UseCases\User;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Application\DTO\User\FetchUserDTO;

class FetchUserUseCase
{
  public function __construct(
    private UserRepositoryInterface $userRepo,
  ) {}

  /**
   * @return FetchUserDTO
   */
  public function execute(string $uuid): FetchUserDTO
  {
    $user = $this->userRepo->fetch($uuid);
    return FetchUserDTO::fromEntity($user);
  }
}