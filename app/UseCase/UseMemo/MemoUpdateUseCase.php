<?php

namespace App\UseCase\UseMemo;

use Illuminate\Support\Facades\DB;



Class MemoUpdateUseCase {

    public function memoUpdate($request){

        // dd($request);


        $id = $request['edit_id'];
        $title = $request['edit_title'];
        $content = $request['edit_content'];


        DB::table('memos')
        ->where('memo_id', $id)
        ->update(['title'=> $title, 'text'=> $content]);

        $update_memo = DB::table('memos')
        ->where('memo_id', $id)
        ->first();

        // セッション更新
        session()->put('select_memo', $update_memo);
    }
}