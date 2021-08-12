<?php

namespace App\UseCase\UseMemo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


Class MemoLockReleaseUseCase {
    public function memoRelease($request){

        // 認証ユーザーの取得
        $user = Auth::user();

        // 選択されたメモid取得
        $memo_id = $request->input('memo_id');

        // 入力されたパスワード取得
        $input_password = $request->input('memo_password');

        // パスワード認証チェック
        if (Hash::check($input_password, $user->password)){
            // 認証成功
            DB::table('memos')
            ->where('memo_id', $memo_id)
            ->update(['key_lock_status'=> 'true']);
        }

        // 選択中メモ セッション更新
        $memo = DB::table('memos')
        ->where('memo_id', $memo_id)
        ->first();

        session()->put('select_memo', $memo);
    }
}