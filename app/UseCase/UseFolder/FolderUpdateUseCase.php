<?php

namespace App\UseCase\UseFolder;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


Class FolderUpdateUseCase {

    public function folderUpdate($request){
        $folder = new Folder;

        // dd($request);

        $int_edit_id = $request['folder_id'];
        // 数値に変換
        $edit_id = (int) $int_edit_id;
        $edit_name = $request['folder_name'];


        $folder = DB::table('folders')
        ->where('folder_id', $edit_id)
        ->update(['folder_name'=> $edit_name]);

    }
}