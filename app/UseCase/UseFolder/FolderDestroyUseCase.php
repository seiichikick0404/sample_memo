<?php
namespace App\UseCase\UseFolder;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;



Class FolderDestroyUseCase {

    public function folderDestroy (Request $request){
        $folder = DB::table('folders')
        ->where('folder_id', $request->id)
        ->delete();
    }
}
