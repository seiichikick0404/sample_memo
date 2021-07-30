<?php
namespace App\UseCase\UseFolder;


use Illuminate\Support\Facades\DB;



Class FolderGetUseCase {

    public function getFolder($user){
        // フォルダ一覧取得
        $folders = DB::table('folders')
        ->select('folder_name', 'folder_id')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return $folders;
    }
}