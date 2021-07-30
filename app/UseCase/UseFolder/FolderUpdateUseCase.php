<?php

namespace App\UseCase\UseFolder;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


Class FolderUpdateUseCase {

    public function FolderUpdate($request){
        $folder = new Folder;

        $int_edit_id = $request->input('folder_id');
        // 数値に変換
        $edit_id = (int) $int_edit_id;
        $edit_name = $request->input('folder_name');

        //ログイン中のユーザーid取得
        $user_id = Auth::id();

        $folder = DB::table('folders')
        ->where('folder_id', $edit_id)
        ->update(['folder_name'=> $edit_name]);

    }
}