<?php

namespace App\Domain\Repositories;

use App\Models\User;
use App\Application\DTO\User\StoreUserDTO;

interface UserRepositoryInterface
{
  public function list(): array;
  public function fetch(string $uuid): ?User;
  public function store(StoreUserDTO $user): User;
  public function findByEmail(string $email): ?User;
  public function update(User $user): User;
  public function delete(User $user): void;
}