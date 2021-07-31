<?php

namespace App\UseCase\UseMemo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\GetNewMemo;


Class MemoDestroyUseCase {

    public function memoDestroy($request){
        $id = $request->id;
        DB::table('memos')
        ->where('memo_id', $id)
        ->delete();

        // 新規メモ取得
        $session_memo = GetNewMemo::GetMemo();

        // セッション更新
        session()->put('select_memo', $session_memo);
    }
}