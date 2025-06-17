<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function list()
    {
        try {
            $perPage = (int) request()->query('perPage', 10);
            $page = (int) request()->query('page', 1);

            $perPage = $perPage > 0 ? $perPage : 10;
            $page = $page > 0 ? $page : 1;

            $query = Profile::orderBy('created_at', 'desc');

            $total = $query->count();

            $profiles = $query
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'data' => $profiles,
                'meta' => [
                    'total' => $total,
                    'perPage' => $perPage,
                    'currentPage' => $page,
                    'lastPage' => ceil($total / $perPage),
                ]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function fetch($uuid) 
    {
        try {

            return Profile::where('uuid', $uuid)->first();

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }   
    }

    public function store(Request $request) 
    {
        $body = $request->all();

        try {
            
            $newProfile = Profile::create([
                'profile' => $body['profile'],
                'description' => $body['description'],
            ]);

            return response()->json([
                'message' => 'Profile created successfully!',
                'data' => $newProfile
            ], 201);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $uuid)
    {
        $body = $request->all();

        try {

            $profile = Profile::where('uuid', $uuid)->first();
            
            if (!$profile) {
                return response()->json([
                    'message' => 'Profile not found!',
                ], 404);
            }

            $profile->update([
                'profile' => $body['profile'],
                'description' => $body['description'],
            ]);

            return response()->json([
                'message' => 'Profile updated successfully!',
                'data' => $profile
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function delete($uuid)
    {
        try {

            $profile = Profile::where('uuid', $uuid)->first();
            
            if (!$profile) {
                return response()->json([
                    'message' => 'Profile not found!',
                ], 404);
            }
            
            $profile->delete();

            return response()->json([
                'message' => 'User was deleted successfully!',
                'data' => $profile
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
