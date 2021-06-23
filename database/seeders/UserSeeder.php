<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            ['name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('test12345'),
            ],
            ['name' => 'test2',
            'email' => 'test2@test.com',
            'password' => Hash::make('test123456'),
            ],
            ['name' => 'test3',
            'email' => 'test3@test.com',
            'password' => Hash::make('test1234567'),
            ]
        ]);
    }
}
