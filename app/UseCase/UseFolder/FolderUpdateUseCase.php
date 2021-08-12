<?php

namespace App\UseCase\UseFolder;

use App\Models\Folder;
use Illuminate\Support\Facades\DB;



Class FolderUpdateUseCase {

    public function folderUpdate($request){
        $folder = new Folder;

        $int_edit_id = $request['folder_id'];
        // 数値に変換
        $edit_id = (int) $int_edit_id;
        $edit_name = $request['folder_name'];


        $folder = DB::table('folders')
        ->where('folder_id', $edit_id)
        ->update(['folder_name'=> $edit_name]);

        // 更新フォルダ取得
        $session_folder = DB::table('folders')
        ->where('folder_id', $edit_id)
        ->first();

        // 更新フォルダに属するメモ取得
        $session_memo = DB::table('memos')
        ->where('folder_id', $edit_id)
        ->orderBy('created_at', 'desc')
        ->first();

        // セッション更新
        session()->put('select_folder', $session_folder);
        session()->put('select_memo', $session_memo);

    }
}