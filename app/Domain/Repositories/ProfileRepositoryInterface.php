<?php

namespace App\Domain\Repositories;

use App\Application\DTO\Profile\StoreProfileDTO;
use App\Models\Profile;

interface ProfileRepositoryInterface
{
  public function list(): array;
  public function fetch(string $uuid): ?Profile;
  public function store(StoreProfileDTO $dto): Profile;
  public function update(Profile $profile): Profile;
  public function delete(Profile $profile): void;
}