<?php

namespace App\UseCase\UseFolder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class FolderSelectAllUseCase
{
    public function folderSelectAll($request){


        if ($request->key === 'all'){

            $user = Auth::user();
            $parent_folder = $request->key;

            session()->put('parent_folder', $parent_folder);

            $memo = DB::table('memos')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

            session()->put('select_memo', $memo);

        }

    }
}