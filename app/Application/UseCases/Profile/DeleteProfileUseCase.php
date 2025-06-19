<?php

namespace App\Application\UseCases\Profile;

use App\Domain\Repositories\ProfileRepositoryInterface;

class DeleteProfileUseCase
{
  public function __construct(private ProfileRepositoryInterface $profileRepo){}

  public function execute(string $uuid): void
  {
    $profile = $this->profileRepo->fetch($uuid);
    $this->profileRepo->delete($profile);
  }
}