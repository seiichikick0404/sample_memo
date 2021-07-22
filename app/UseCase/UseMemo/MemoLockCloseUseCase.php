<?php

namespace App\UseCase\UseMemo;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Services\GetNewMemo;

Class MemoLockCloseUseCase {
    public function memoClose($request){


        //認証ユーザ取得
        $user = Auth::user();

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