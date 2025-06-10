<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'uuid' => 'e0ce6679-9a1f-413b-ae3d-409b715aac50',
            'permission' => 'Access',
            'description' => 'Permission for the user to access the module',
        ]);

        Permission::create([
            'uuid' => '4a80c2da-6174-4e10-902a-7162a723462e',
            'permission' => 'Register',
            'description' => 'Permission for the user to register new records in the module.',
        ]);

        Permission::create([
            'uuid' => '1d270ba8-e7b8-49c9-ac6d-5438f63835ed',
            'permission' => 'Update',
            'description' => 'Permission for the user to update records on module.',
        ]);

        Permission::create([
            'uuid' => 'b6d62303-0e35-460a-b22d-abe82d8be46a',
            'permission' => 'Delete',
            'description' => 'Permission for the user to delete records on module.',
        ]);
    }
}
