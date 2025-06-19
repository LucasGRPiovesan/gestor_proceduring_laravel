<?php

namespace Tests\Unit\Application\UseCases\Profile;

use Tests\TestCase;
use App\Application\DTO\Profile\{FetchProfileDTO, StoreProfileDTO};
use App\Application\UseCases\Profile\StoreProfileUseCase;
use App\Domain\Repositories\ProfileRepositoryInterface;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Mockery;

class StoreProfileUseCaseTest extends TestCase
{
  public function test_should_store_profile_and_return_fetch_dto()
  {
    $data = [
      'profile' => 'Admin',
      'description' => 'Administrator profile'
    ];

    $profile = new Profile();
    $profile->uuid = 'uuid-test';
    $profile->profile = $data['profile'];
    $profile->description = $data['description'];
    $profile->created_at = Carbon::now(); 

    $repoMock = Mockery::mock(ProfileRepositoryInterface::class);
    $repoMock->shouldReceive('store')
      ->once()
      ->with(Mockery::on(function ($dto) use ($data) {
        return $dto instanceof StoreProfileDTO &&
          $dto->profile === $data['profile'] &&
          $dto->description === $data['description'];
      }))
      ->andReturn($profile);

    $useCase = new StoreProfileUseCase($repoMock);
    $result = $useCase->execute($data);

    $this->assertInstanceOf(FetchProfileDTO::class, $result);
    $this->assertEquals('uuid-test', $result->uuid);
    $this->assertEquals('Admin', $result->profile);
    $this->assertEquals('Administrator profile', $result->description);
  }

  public function test_should_throw_invalid_argument_exception()
  {
    $data = ['profile' => '', 'description' => ''];

    $repoMock = Mockery::mock(ProfileRepositoryInterface::class);
    $useCase = new StoreProfileUseCase($repoMock);

    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('profile is required.');

    $useCase->execute($data);
  }

  public function test_should_throw_database_exception()
  {
    $data = ['profile' => 'Admin', 'description' => '...'];

    $repoMock = Mockery::mock(ProfileRepositoryInterface::class);
    $repoMock->shouldReceive('store')
      ->once()
      ->andThrow(new QueryException('', [], new \Exception('DB error')));

    $useCase = new StoreProfileUseCase($repoMock);

    $this->expectException(QueryException::class);
    $useCase->execute($data);
  }

  public function test_should_throw_generic_exception()
  {
    $data = ['profile' => 'Admin', 'description' => '...'];

    $repoMock = Mockery::mock(ProfileRepositoryInterface::class);
    $repoMock->shouldReceive('store')
      ->once()
      ->andThrow(new \Exception('Unexpected error'));

    $useCase = new StoreProfileUseCase($repoMock);

    $this->expectException(\Throwable::class);
    $useCase->execute($data);
  }

  protected function tearDown(): void
  {
    parent::tearDown();
    Mockery::close();
  }
}
