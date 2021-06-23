<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('memos')->insert([
            ['title' => 'PHPの使い方',
            'text' => 'PHPはとても使いやすいプログラミング言語です',
            'user_id' => 1,
            'folder_id'=> 1,
            ],
            ['title' => 'Rubyの使い方',
            'text' => 'Rubyは日本で作られたプログラミング言語です',
            'user_id' => 1,
            'folder_id'=> 1,
            ],
            ['title' => 'JavaScriptの使い方',
            'text' => 'JavaScriptは世界でとても人気なプログラミング言語です',
            'user_id' => 1,
            'folder_id'=> 1,
            ],
        ]);
    }
}
