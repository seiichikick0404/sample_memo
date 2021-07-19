<?php

namespace App\UseCase\UseMemo;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

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