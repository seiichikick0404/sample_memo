<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('folders')->insert([
            ['folder_name' => 'PHPフォルダ',
            'user_id' => 1,
            ],
            ['folder_name' => 'Rubyフォルダ',
            'user_id' => 1,
            ],
            ['folder_name' => 'JavaScriptフォルダ',
            'user_id' => 1,
            ]
        ]);
    }
}
