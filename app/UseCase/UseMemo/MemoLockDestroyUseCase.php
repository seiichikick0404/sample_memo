<?php

namespace App\UseCase\UseMemo;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Services\GetNewMemo;

Class MemoLockDestroyUseCase {

    public function lockDestroy($request){

        // メモflag実行
        $id = $request->id;
        $memo_lock_destroy = DB::table('memos')
        ->where('memo_id', $id)
        ->update(['key_flag'=> NUll, 'key_lock_status'=> NUll]);


        // 選択中メモ セッション更新
        $memo = DB::table('memos')
        ->where('memo_id', $id)
        ->first();

        session()->put('select_memo', $memo);

    }
}