<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\User\{DeleteUserUseCase, ListUserUseCase, FetchUserUseCase, StoreUserUseCase, UpdateUserUseCase};

class UserController extends Controller
{
    private ListUserUseCase $listUserUseCase;
    private FetchUserUseCase $fetchUserUseCase;
    private StoreUserUseCase $storeUserUseCase;
    private UpdateUserUseCase $updateUserUseCase;
    private DeleteUserUseCase $deleteUserUseCase;

    public function __construct(
        ListUserUseCase $listUserUseCase,
        FetchUserUseCase $fetchUserUseCase,
        StoreUserUseCase $storeUserUseCase,
        UpdateUserUseCase $updateUserUseCase,
        DeleteUserUseCase $deleteUserUseCase
    ) {
        $this->listUserUseCase = $listUserUseCase;
        $this->fetchUserUseCase = $fetchUserUseCase;
        $this->storeUserUseCase = $storeUserUseCase;
        $this->updateUserUseCase = $updateUserUseCase;
        $this->deleteUserUseCase = $deleteUserUseCase;
    }

    public function list()
    {
        try {

            $data = $this->listUserUseCase->execute(request());
            return response()->json($data, 200);

        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function fetch($uuid) 
    {
        try {

            $user = $this->fetchUserUseCase->execute($uuid);
            return response()->json($user, 200);

        } catch (\Illuminate\Database\QueryException $e) {

            return response()->json([
                'error' => 'Invalid UUID format.',
                'message' => $e->getMessage(),
            ], 400);
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'User not found!',
                'message' => $e->getMessage()
            ], 404);
        
        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }   
    }

    public function store(Request $request) 
    {
        $body = $request->all();

        try {

            $user = $this->storeUserUseCase->execute($body);
            return response()->json($user, 200);

        } catch (\InvalidArgumentException $e) {

            return response()->json([
                'error' => 'Invalid data provided.',
                'message' => $e->getMessage()
            ], 422);
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'Profile not found!',
                'message' => $e->getMessage()
            ], 404);
        
        } catch (\Illuminate\Database\QueryException $e) {

            return response()->json([
                'error' => 'Database error.',
                'message' => $e->getMessage(),
            ], 500);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, string $uuid)
    {
        try {

            $updated = $this->updateUserUseCase->execute($uuid, $request->all());

            return response()->json([
                'message' => 'Profile updated successfully!',
                'data' => $updated
            ], 200);

        } catch (\InvalidArgumentException $e) {

            return response()->json([
                'error' => 'Invalid data provided.',
                'message' => $e->getMessage()
            ], 422);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json([
                'error' => 'Profile not found.'
            ], 404);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($uuid)
    {
        try {

            $this->deleteUserUseCase->execute($uuid);
            return response()->json([
                'message' => 'User was deleted successfully!'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json([
                'error' => 'Profile not found.',
                'message' => $e->getMessage()
            ], 404);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
