<?php

namespace App\Application\UseCases\Profile;

use App\Application\DTO\Profile\FetchProfileDTO;
use App\Application\DTO\Profile\StoreProfileDTO;
use App\Domain\Repositories\ProfileRepositoryInterface;

class StoreProfileUseCase
{
  public function __construct(
    private ProfileRepositoryInterface $profileRepo
  ) {}

  /**
   * @return FetchProfileDTO
   */
  public function execute(array $data): FetchProfileDTO
  {
    $dto = StoreProfileDTO::fromArray($data);
    
    $profile = $this->profileRepo->store($dto);
    return FetchProfileDTO::fromEntity($profile);
  }
}