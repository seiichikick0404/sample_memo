<?php

namespace App\UseCase\UseMemo;

use Illuminate\Support\Facades\DB;


Class MemoSelectUseCase {

    public function selectMemo ($request){

        //メモid取得
        $id = $request->id;
        $memo = DB::table('memos')
        ->where('memo_id', $id)
        ->first();

        session()->put('select_memo', $memo);

    }
}