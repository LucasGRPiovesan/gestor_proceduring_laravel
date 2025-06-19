<?php

namespace App\Application\UseCases\User;

use Illuminate\Http\Request;
use App\Application\DTO\User\ListUserDTO;
use App\Domain\Repositories\UserRepositoryInterface;

class ListUserUseCase
{
  public function __construct(
    private UserRepositoryInterface $userRepo,
  ) {}

  /**
   * @return ListUserDTO[]
   */
  public function execute(Request $request): array
  {
    ListUserDTO::$perPage = (int) $request->input('perPage', 5);
    ListUserDTO::$page = (int) $request->input('page', 1);

    $data = $this->userRepo->list();
    return ListUserDTO::fromMany($data);
  }
}