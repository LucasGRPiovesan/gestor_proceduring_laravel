<?php

namespace Database\Seeders;

use App\Models\ProfilePermissionModule;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;

class ProfilePermissionModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin - SETTINGS
        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88121',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa1',
        ]);

        // Admin - PROFILES
        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88122',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa2',
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88123',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa3',
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88124',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa4',
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88125',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa5',
        ]);

        // Admin - USERS
        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88126',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa6'
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88127',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa7'
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88128',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa8'
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88129',
            'uuid_profile' => 'd4a5a351-5b70-421a-bd87-feca0f02cc06',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa9'
        ]);

        // Operator - SETTINGS
        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88130',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa1',
        ]);

        // Operator - PROFILES
        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88131',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa2',
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88132',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa3',
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88133',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa4',
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88134',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa5',
        ]);

        // Operator - USERS
        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88135',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa6'
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88136',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa7'
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88137',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa8'
        ]);

        ProfilePermissionModule::create([
            'uuid' => '7d1a2b5a-11d9-4c81-b8a9-769b85f88138',
            'uuid_profile' => '1d6440b1-7af3-42ab-b859-c2fbe98cb99a',
            'uuid_permission_module'=> '2acf047c-a9d7-42ce-875c-0927e1763fa9'
        ]);
    }
}
