<?php

namespace App\UseCase\UseFolder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class FolderSelectUseCase
{
    public function folderSelect($request){


        // フォルダ セッション更新
        $id = $request->id;
        $folder = DB::table('folders')
        ->where('folder_id', $id)
        ->first();
        session()->put('select_folder', $folder);

        // メモ セッション更新
        $memo = DB::table('memos')
        ->where('folder_id', $id)
        ->orderBy('created_at', 'desc')
        ->first();

        session()->put('select_memo', $memo);
        session()->remove('parent_folder');

    }
}