<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'root',
                'email' => 'root@example.org',
                'access_level' => 4,
                'password' => Hash::make('password'),
                'org_id' => 1
            ],
            [
                'name' => 'admin',
                'email' => 'admin@example.org',
                'access_level' => 3,
                'password' => Hash::make('password'),
                'org_id' => 1
            ],
            [
                'name' => 'finmanager',
                'email' => 'finmanager@example.org',
                'access_level' => 2,
                'password' => Hash::make('password'),
                'org_id' => 1
            ],
            [
                'name' => 'editor',
                'email' => 'editor@example.org',
                'access_level' => 1,
                'password' => Hash::make('password'),
                'org_id' => 1
            ],
            [
                'name' => 'user',
                'email' => 'user@example.org',
                'access_level' => 0,
                'password' => Hash::make('password'),
                'org_id' => null
            ]
        ]);
    }
}
