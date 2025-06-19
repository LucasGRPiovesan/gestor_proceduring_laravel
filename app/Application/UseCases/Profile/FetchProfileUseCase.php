<?php

namespace App\Application\UseCases\Profile;

use App\Application\DTO\Profile\FetchProfileDTO;
use App\Domain\Repositories\ProfileRepositoryInterface;

class FetchProfileUseCase
{
  public function __construct(
    private ProfileRepositoryInterface $profileRepo,
  ) {}

  /**
   * @return FetchProfileDTO
   */
  public function execute(string $uuid): FetchProfileDTO
  {
    $user = $this->profileRepo->fetch($uuid);
    return FetchProfileDTO::fromEntity($user);
  }
}