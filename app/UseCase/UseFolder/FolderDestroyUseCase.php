<?php
namespace App\UseCase\UseFolder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



Class FolderDestroyUseCase {

    public function folderDestroy (Request $request){
        $folder = DB::table('folders')
        ->where('folder_id', $request->id)
        ->delete();

        // 親フォルダの取得
        $parent_folder = session()->get('parent_folder');

        // セッション削除 (削除後全ファイルフォルダの選択)
        session()->forget('parent_folder');
        session()->forget('select_folder');
    }
}
