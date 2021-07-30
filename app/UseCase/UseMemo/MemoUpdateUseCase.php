<?php

namespace App\UseCase\UseMemo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


Class MemoUpdateUseCase {

    public function memoUpdate($request){

        $id = $request->edit_id;
        $title = $request->input('edit_title');
        $content = $request->input('edit_content');

        DB::table('memos')
        ->where('memo_id', $id)
        ->update(['title'=> $title, 'text'=> $content]);


        $update_memo = DB::table('memos')
        ->where('memo_id', $id)
        ->get();

        // セッション更新
        session()->put('select_memo', $update_memo);


    }
}