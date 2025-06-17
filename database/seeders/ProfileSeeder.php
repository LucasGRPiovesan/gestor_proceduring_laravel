<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'uuid' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'profile' => 'Admin',
            'description' => 'System Administrator',
        ]);

        Profile::create([
            'uuid' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'profile' => 'Operator',
            'description' => 'Common user with limited access',
        ]);
    }
}
