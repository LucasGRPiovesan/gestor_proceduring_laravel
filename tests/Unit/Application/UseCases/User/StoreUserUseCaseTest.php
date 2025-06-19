<?php

namespace Tests\Unit\Application\UseCases\User;

use Tests\TestCase;
use App\Application\DTO\User\{StoreUserDTO, FetchUserDTO};
use App\Application\UseCases\User\StoreUserUseCase;
use App\Domain\Repositories\{UserRepositoryInterface, ProfileRepositoryInterface};
use App\Models\{User, Profile};
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Mockery;

class StoreUserUseCaseTest extends TestCase
{
  public function test_should_store_user_and_return_fetch_dto()
  {
    $data = [
      'uuid_profile' => 'b4dc3e2f-1a73-4a56-bf97-bcb1e21f7c52',
      'name' => 'John Doe',
      'email' => 'john@example.com',
      'password' => 'secret123'
    ];

    $profile = new Profile();
    $profile->uuid = $data['uuid_profile'];
    $profile->profile = 'Admin';
    $profile->description = 'Administrador';
    $profile->created_at = Carbon::now();

    $user = new User();
    $user->uuid = 'uuid-user-test';
    $user->uuid_profile = $data['uuid_profile'];
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->created_at = Carbon::now();
    $user->profile = $profile;

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $profileRepoMock = Mockery::mock(ProfileRepositoryInterface::class);

    $profileRepoMock->shouldReceive('fetch')
      ->withArgs(function ($uuid) use ($data) {
          return $uuid === $data['uuid_profile'];
      })
      ->once()
      ->andReturn($profile);

    $userRepoMock->shouldReceive('store')
      ->once()
      ->with(Mockery::on(function ($dto) use ($data) {
        return $dto instanceof StoreUserDTO &&
          $dto->uuid_profile === $data['uuid_profile'] &&
          $dto->name === $data['name'] &&
          $dto->email === $data['email'] &&
          $dto->password === $data['password'];
      }))
      ->andReturn($user);


    $useCase = new StoreUserUseCase($userRepoMock, $profileRepoMock);
    $result = $useCase->execute($data);

    $this->assertInstanceOf(FetchUserDTO::class, $result);
    $this->assertEquals('uuid-user-test', $result->uuid);
    $this->assertEquals('John Doe', $result->name);
    $this->assertEquals('john@example.com', $result->email);
  }

  public function test_should_throw_invalid_argument_exception()
  {
    $data = [
      'uuid_profile' => '',
      'name' => '',
      'email' => '',
      'password' => ''
    ];

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $profileRepoMock = Mockery::mock(ProfileRepositoryInterface::class);

    $useCase = new StoreUserUseCase($userRepoMock, $profileRepoMock);

    $this->expectException(\InvalidArgumentException::class);
    $this->expectExceptionMessage('uuid_profile is required.');

    $useCase->execute($data);
  }

  public function test_should_throw_model_not_found_exception()
  {
    $data = [
      'uuid_profile' => 'nonexistent-profile-uuid',
      'name' => 'Jane Doe',
      'email' => 'jane@example.com',
      'password' => 'secret'
    ];

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $profileRepoMock = Mockery::mock(ProfileRepositoryInterface::class);

    $profileRepoMock->shouldReceive('fetch')
      ->once()
      ->with($data['uuid_profile'])
      ->andThrow(new ModelNotFoundException("Profile not found"));

    $useCase = new StoreUserUseCase($userRepoMock, $profileRepoMock);

    $this->expectException(ModelNotFoundException::class);
    $this->expectExceptionMessage('Profile not found');

    $useCase->execute($data);
  }

  public function test_should_throw_database_exception()
  {
    $data = [
      'uuid_profile' => 'uuid-profile',
      'name' => 'Someone',
      'email' => 'someone@example.com',
      'password' => 'pwd'
    ];

    $profile = new Profile();
    $profile->uuid = $data['uuid_profile'];

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $profileRepoMock = Mockery::mock(ProfileRepositoryInterface::class);

    $profileRepoMock->shouldReceive('fetch')
      ->once()
      ->with($data['uuid_profile'])
      ->andReturn($profile);

    $userRepoMock->shouldReceive('store')
      ->once()
      ->andThrow(new QueryException('', [], new \Exception('DB error')));

    $useCase = new StoreUserUseCase($userRepoMock, $profileRepoMock);

    $this->expectException(QueryException::class);

    $useCase->execute($data);
  }

  public function test_should_throw_generic_exception()
  {
    $data = [
      'uuid_profile' => 'uuid-profile',
      'name' => 'Generic',
      'email' => 'generic@example.com',
      'password' => 'genericpass'
    ];

    $profile = new Profile();
    $profile->uuid = $data['uuid_profile'];

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $profileRepoMock = Mockery::mock(ProfileRepositoryInterface::class);

    $profileRepoMock->shouldReceive('fetch')
      ->once()
      ->with($data['uuid_profile'])
      ->andReturn($profile);

    $userRepoMock->shouldReceive('store')
      ->once()
      ->andThrow(new \Exception('Unexpected error'));

    $useCase = new StoreUserUseCase($userRepoMock, $profileRepoMock);

    $this->expectException(\Throwable::class);
    $this->expectExceptionMessage('Unexpected error');

    $useCase->execute($data);
  }

  protected function tearDown(): void
  {
    parent::tearDown();
    Mockery::close();
  }
}
