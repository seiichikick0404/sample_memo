<?php

namespace App\UseCase\UseMemo;

use Illuminate\Support\Facades\DB;
use App\Services\GetNewMemo;


Class MemoDestroyUseCase {

    public function memoDestroy($request){
        $id = $request->id;
        DB::table('memos')
        ->where('memo_id', $id)
        ->delete();

        // 親フォルダの取得
        $parent_folder = session()->get('parent_folder');

        // 選択中フォルダの最新メモ取得
        $select_folder = session()->get('select_folder');

        // 最新メモの取得
        if ($parent_folder === 'all'){
            $session_memo = GetNewMemo::GetMemo();
        }
        // 選択フォルダ内の最新メモ
        elseif ($parent_folder === NULL){
            $session_memo = DB::table('memos')
            ->where('folder_id', $select_folder->folder_id)
            ->orderBy('created_at', 'desc')
            ->first();
        }

        // セッション更新
        session()->put('select_memo', $session_memo);
    }
}