<?php
namespace App\UseCase\UseMemo;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


Class MemoGetUseCase {

    // メモ一覧取得(全てのメモ)
    public function getAllMemo($user){
        $memos = DB::table('memos')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return $memos;
    }

    // メモ一覧取得(フォルダに属する)
    public function parentFolder($select_folder){
        $memos = DB::table('memos')
        ->where('folder_id', $select_folder->folder_id)
        ->orderBy('created_at', 'desc')
        ->get();

        return $memos;
    }
}
