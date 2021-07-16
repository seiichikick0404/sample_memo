<?php

namespace App\UseCase\UseFolder;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


Class FolderCreateUseCase {

    public function FolderCreate($request){

            $folder = new Folder;

            // ログイン中のユーザーid取得
            $user_id = Auth::id();

            // フォルダ登録処理
            $folder->folder_name = $request->input('folder_name');
            $folder->user_id = $user_id;

            $folder->save();

            // フォルダ セッション更新
            $folder = DB::table('folders')
            ->where('folder_id', $folder->folder_id)
            ->first();
            session()->put('select_folder', $folder);
            
    }
}
