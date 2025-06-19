<?php

namespace App\Application\UseCases\Profile;

use Illuminate\Http\Request;
use App\Application\DTO\Profile\ListProfileDTO;
use App\Domain\Repositories\ProfileRepositoryInterface;

class ListProfileUseCase
{
  public function __construct(
    private ProfileRepositoryInterface $profileRepo,
  ) {}

  /**
   * @return ListProfileDTO[]
   */
  public function execute(Request $request): array
  {
    ListProfileDTO::$perPage = (int) $request->input('perPage', 5);
    ListProfileDTO::$page = (int) $request->input('page', 1);

    $data = $this->profileRepo->list();
    return ListProfileDTO::fromMany($data);
  }
}