<?php
namespace App\UseCase\UseFolder;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


Class FolderDestroyUseCase {

    public function folderDestroy ($request){
        $folder = new Folder;
        $folder = DB::table('folders')
        ->where('folder_id', $request->id)
        ->delete();
    }
}
