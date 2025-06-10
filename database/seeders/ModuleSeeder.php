<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::create([
            'uuid' => 'fb7c21b2-daf8-4c21-9909-85b5cbe3f76a',
            'module' => 'Settings',
            'description' => 'System settings',
        ]);

        Module::create([
            'uuid' => '5caeaf3f-4305-4881-9b13-150b16ef88e1',
            'uuid_module' => 'fb7c21b2-daf8-4c21-9909-85b5cbe3f76a',
            'module' => 'Profiles',
            'description' => 'System profiles and permissions',
        ]);

        Module::create([
            'uuid' => '686e9c5e-e4ed-4262-8bb8-979ee5cb0eb7',
            'uuid_module' => 'fb7c21b2-daf8-4c21-9909-85b5cbe3f76a',
            'module' => 'Users',
            'description' => 'System users',
        ]);
    }
}
