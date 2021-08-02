<?php

namespace App\UseCase\UseFolder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class FolderSelectFirstUseCase
{
    public function folderSelectFirst($parent_folder){

        // 認証ユーザー取得
        $user = Auth::user();

        session()->put('parent_folder', $parent_folder);

        $memo = DB::table('memos')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->first();

        session()->put('select_memo', $memo);


    }
}