<?php

namespace App\Infrastructure\Repositories;

use App\Models\User;
use App\Application\DTO\User\ListUserDTO;
use App\Application\DTO\User\StoreUserDTO;
use Application\DTO\UpdateUserDTO;
use App\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
  public function __construct(){}

  public function findByEmail(string $email): ?User
  {
    return User::where('email', $email)->first();
  }

  public function list(): array
  {
    $query = User::with('profile')
      ->whereHas('profile')
      ->orderBy('created_at', 'desc');

    ListUserDTO::$total = $query->count();

    return $query
      ->skip((ListUserDTO::$page - 1) * ListUserDTO::$perPage)
      ->take(ListUserDTO::$perPage)
      ->get()
      ->all();
  }

  public function fetch(string $uuid): ?User
  {
    return User::where('uuid', $uuid)->with('profile')->firstOrFail();
  }

  public function store(StoreUserDTO $user): User
  {
    return User::create([
      'uuid_profile' => $user->uuid_profile,
      'name' => $user->name,
      'email' => $user->email,
      'password' => Hash::make($user->password)
    ]);
  }

  public function update(User $user): User
  {
    $user->save();
    return $user;
  }

  public function delete(User $user): void
  {
    $user->delete();
  }
}