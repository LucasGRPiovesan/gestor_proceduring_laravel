<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'uuid' => (string) Str::uuid(),
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'name' => 'Lucas Piovesan',
            'email' => 'lucas.piovesan.dev@gmail.com',
            'password' => Hash::make(123456)
        ]);
    }
}
