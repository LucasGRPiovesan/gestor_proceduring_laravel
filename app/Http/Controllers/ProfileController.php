<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Application\UseCases\Profile\{DeleteProfileUseCase, ListProfileUseCase, FetchProfileUseCase, StoreProfileUseCase, UpdateProfileUseCase};

class ProfileController extends Controller
{
    private ListProfileUseCase $listProfileUseCase;
    private FetchProfileUseCase $fetchProfileUseCase;
    private StoreProfileUseCase $storeProfileUseCase;
    private UpdateProfileUseCase $updateProfileUseCase;
    private DeleteProfileUseCase $deleteProfileUseCase;

    public function __construct(
        ListProfileUseCase $listProfileUseCase,
        FetchProfileUseCase $fetchProfileUseCase,
        StoreProfileUseCase $storeProfileUseCase,
        UpdateProfileUseCase $updateProfileUseCase,
        DeleteProfileUseCase $deleteProfileUseCase
    ) {
        $this->listProfileUseCase = $listProfileUseCase;
        $this->fetchProfileUseCase = $fetchProfileUseCase;
        $this->storeProfileUseCase = $storeProfileUseCase;
        $this->updateProfileUseCase = $updateProfileUseCase;
        $this->deleteProfileUseCase = $deleteProfileUseCase;
    }

    public function list()
    {
        try {

            $data = $this->listProfileUseCase->execute(request());
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function fetch($uuid) 
    {
        try {

            $profile = $this->fetchProfileUseCase->execute($uuid);
            return response()->json($profile, 200);

        } catch (\Illuminate\Database\QueryException $e) {

            return response()->json([
                'error' => 'Invalid UUID format.',
                'message' => $e->getMessage(),
            ], 400);
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'Profile not found!',
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

            $user = $this->storeProfileUseCase->execute($body);
            return response()->json($user, 200);

        } catch (\InvalidArgumentException $e) {

            return response()->json([
                'error' => 'Invalid data provided.',
                'message' => $e->getMessage()
            ], 422);
        
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

            $updated = $this->updateProfileUseCase->execute($uuid, $request->all());

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

            $this->deleteProfileUseCase->execute($uuid);
            return response()->json([
                'message' => 'Profile was deleted successfully!'
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

    public function options()
    {
        try {
            $profiles = Profile::orderBy('profile', 'asc')
                ->get(['uuid', 'profile']);

            $options = $profiles->map(function ($item) {
                return [
                    'value' => $item->uuid,
                    'label' => $item->profile,
                ];
            });

            return response()->json($options, 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
