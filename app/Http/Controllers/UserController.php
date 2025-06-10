<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function list()
    {
        try {
            
            $users = User::with('profile')->get();
            return response()->json($users, 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function fetch($uuid) 
    {
        try {

            return User::where('uuid', $uuid)->with('profile')->first();

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }   
    }

    public function post(Request $request) 
    {
        $body = $request->all();

        try {
            
            $newUser = User::create([
                'uuid_profile' => $body['uuid_profile'],
                'name' => $body['name'],
                'email' => $body['email'],
                'password' => Hash::make($body['password'])
            ]);

            return response()->json([
                'message' => 'User created successfully!',
                'data' => $newUser
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function delete($uuid)
    {
        try {

            $user = User::where('uuid', $uuid)->first();
            
            if (!$user) {
                return response()->json([
                    'message' => 'User not found!',
                ], 404);
            }
            
            $user->delete();

            return response()->json([
                'message' => 'User was deleted successfully!',
                'data' => $user
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
