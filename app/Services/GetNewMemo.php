<?php

namespace App\Services;


use App\Models\Memo;
use Illuminate\Support\Facades\DB;


class GetNewMemo
{
    // 新規メモの取得
    public static function GetMemo(){

        $session_memo = DB::table('memos')
        ->orderBy('created_at', 'desc')
        ->first();

        return $session_memo;
    }
}