<?php

namespace App\Application\UseCases\User;

use App\Domain\Repositories\UserRepositoryInterface;

class DeleteUserUseCase
{
  public function __construct(private UserRepositoryInterface $userRepo){}

  public function execute(string $uuid): void
  {
    $user = $this->userRepo->fetch($uuid);
    $this->userRepo->delete($user);
  }
}