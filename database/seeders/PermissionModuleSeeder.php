<?php

namespace Database\Seeders;

use App\Models\PermissionModule;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;

class PermissionModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SETTINGS
        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa1',
            'uuid_permission' => 'e0ce6679-9a1f-413b-ae3d-409b715aac50', // Access
            'uuid_module' => 'fb7c21b2-daf8-4c21-9909-85b5cbe3f76a', // Settings
        ]);

        // PROFILES
        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa2',
            'uuid_permission' => 'e0ce6679-9a1f-413b-ae3d-409b715aac50', // Access
            'uuid_module' => '5caeaf3f-4305-4881-9b13-150b16ef88e1', // Profiles
        ]);

        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa3',
            'uuid_permission' => '4a80c2da-6174-4e10-902a-7162a723462e', // Register
            'uuid_module' => '5caeaf3f-4305-4881-9b13-150b16ef88e1', // Profiles
        ]);

        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa4',
            'uuid_permission' => '1d270ba8-e7b8-49c9-ac6d-5438f63835ed', // Update
            'uuid_module' => '5caeaf3f-4305-4881-9b13-150b16ef88e1', // Profiles
        ]);

        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa5',
            'uuid_permission' => 'b6d62303-0e35-460a-b22d-abe82d8be46a', // Delete
            'uuid_module' => '5caeaf3f-4305-4881-9b13-150b16ef88e1', // Profiles
        ]);

        // USERS
        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa6',
            'uuid_permission' => 'e0ce6679-9a1f-413b-ae3d-409b715aac50', // Access
            'uuid_module' => '686e9c5e-e4ed-4262-8bb8-979ee5cb0eb7', // Users
        ]);

        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa7',
            'uuid_permission' => '4a80c2da-6174-4e10-902a-7162a723462e', // Register
            'uuid_module' => '686e9c5e-e4ed-4262-8bb8-979ee5cb0eb7', // Users
        ]);

        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa8',
            'uuid_permission' => '1d270ba8-e7b8-49c9-ac6d-5438f63835ed', // Update
            'uuid_module' => '686e9c5e-e4ed-4262-8bb8-979ee5cb0eb7', // Users
        ]);

        PermissionModule::create([
            'uuid'=> '2acf047c-a9d7-42ce-875c-0927e1763fa9',
            'uuid_permission' => 'b6d62303-0e35-460a-b22d-abe82d8be46a', // Delete
            'uuid_module' => '686e9c5e-e4ed-4262-8bb8-979ee5cb0eb7', // Users
        ]);
    }
}
