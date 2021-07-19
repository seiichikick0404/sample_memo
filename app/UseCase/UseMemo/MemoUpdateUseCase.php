<?php

namespace App\UseCase\UseMemo;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Services\GetNewMemo;

Class MemoUpdateUseCase {

    public function memoUpdate($request){

        $id = $request->edit_id;
        $title = $request->input('edit_title');
        $content = $request->input('edit_content');

        $memo = DB::table('memos')
        ->where('memo_id', $id)
        ->update(['title'=> $title, 'text'=> $content]);
    }
}