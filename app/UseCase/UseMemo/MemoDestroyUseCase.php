<?php

namespace App\UseCase\UseMemo;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Services\GetNewMemo;

Class MemoDestroyUseCase {

    public function MemoDestroy($request){
        $id = $request->id;
        DB::table('memos')
        ->where('memo_id', $id)
        ->delete();
    }
}