<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function list()
    {
        try {
            
            $profiles = Profile::all();
            return response()->json($profiles, 200);
            
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

    public function post(Request $request) 
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
