<?php

namespace App\UseCase\UseMemo;

use Illuminate\Support\Facades\DB;


Class MemoLockCloseUseCase {
    public function memoClose($request){

        // メモflag実行
        $id = $request->id;
        $memo_lock = DB::table('memos')
        ->where('memo_id', $id)
        ->update(['key_lock_status'=> 'false']);


        // 選択中メモ セッション更新
        $memo = DB::table('memos')
        ->where('memo_id', $id)
        ->first();

        session()->put('select_memo', $memo);
    }
}