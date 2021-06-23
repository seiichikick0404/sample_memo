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
            ['title' => 'PHPの汎用コマンド',
            'text' => 'よく使うコマンドです',
            'user_id' => 1,
            'folder_id'=> 1,
            ],
            ['title' => 'Laravelコマンド',
            'text' => 'こちらのコマンドはよく使います',
            'user_id' => 1,
            'folder_id'=> 1,
            ],
            ['title' => 'Rubyの使い方',
            'text' => 'Rubyは日本で作られたプログラミング言語です',
            'user_id' => 1,
            'folder_id'=> 2,
            ],
            ['title' => 'Rubyの汎用コマンド',
            'text' => 'よく使うコマンドです',
            'user_id' => 1,
            'folder_id'=> 2,
            ],
            ['title' => 'Railsコマンド',
            'text' => 'ルーティングを確認するコマンドです',
            'user_id' => 1,
            'folder_id'=> 2,
            ],
            ['title' => 'JavaScriptの使い方',
            'text' => 'JavaScriptは世界でとても人気なプログラミング言語です',
            'user_id' => 1,
            'folder_id'=> 3,
            ],
            ['title' => 'JavaScriptの組み込み関数',
            'text' => 'とてもよく使う関数です',
            'user_id' => 1,
            'folder_id'=> 3,
            ],
            ['title' => 'メソッドの作り方',
            'text' => '関数はまとめて管理しましょう',
            'user_id' => 1,
            'folder_id'=> 3,
            ],
        ]);
    }
}
