<?php

namespace App\UseCase\UseMemo;

use App\Models\Memo;
use Illuminate\Support\Facades\Auth;
use App\Services\GetNewMemo;

Class MemoCreateUseCase {

    public function memoCreate($request){

        $memo = new Memo;

        // ログイン中のユーザーid取得
        $user_id = Auth::id();

        // 選択中のフォルダidを取得
        $folder_id = $request->id;

        // 新規メモ作成
        $memo->title = '新規メモ';
        $memo->text = NUll;
        $memo->user_id = $user_id;
        $memo->folder_id = $folder_id;
        $memo->save();

        // 新規メモ取得
        $session_memo = GetNewMemo::GetMemo();

        // セッション更新
        session()->put('select_memo', $session_memo);
    }
}