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
            $perPage = (int) request()->query('perPage', 10);
            $page    = (int) request()->query('page', 1);

            $perPage = $perPage > 0 ? $perPage : 10;
            $page    = $page > 0   ? $page    : 1;

            $query = User::with('profile')
                        ->orderBy('created_at', 'desc');

            $total = $query->count();

            $users = $query
                ->skip(($page - 1) * $perPage)
                ->take($perPage)
                ->get();

            return response()->json([
                'data' => $users,
                'meta' => [
                    'total'       => $total,
                    'perPage'     => $perPage,
                    'currentPage' => $page,
                    'lastPage'    => ceil($total / $perPage),
                ],
            ], 200);

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

    public function update(Request $request, $uuid)
    {
        $body = $request->all();

        try {

            $user = User::where('uuid', $uuid)->first();
            
            if (!$user) {
                return response()->json([
                    'message' => 'User not found!',
                ], 404);
            }

            $allowedFields = ['uuid_profile', 'name', 'email'];
            $data = collect($body)->only($allowedFields)->toArray();

            $user->update($data);

            return response()->json([
                'message' => 'User updated successfully!',
                'data' => $user
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request) 
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
