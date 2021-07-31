<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\UseCase\UseFolder\FolderSelectUseCase;
use App\UseCase\UseFolder\FolderCreateUseCase;
use App\UseCase\UseFolder\FolderUpdateUseCase;
use App\UseCase\UseFolder\FolderDestroyUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


final class FolderController extends Controller
{

    // フォルダ選択
    public function select(Request $request, FolderSelectUseCase $folder )
    {
        // フォルダー選択処理
        $folder->folderSelect($request);

        return redirect()->route('memo.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FolderCreateUseCase $folder)
    {
        // ログイン済み かつ POSTの場合
        if (auth::check() && $request){

            //フォルダ作成処理
            $folder->folderCreate($request);
            return redirect('/memo');

        }else {
            return redirect('/memo');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        // ログイン済み かつ POSTの場合
        if (auth::check() && $request){

            $folder = new FolderUpdateUseCase;
            $folder->folderUpdate($request);
            return redirect('/memo');

        }else {
            return redirect('/memo');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {

        // ログイン済み かつ POSTの場合
        if (auth::check() && $request){

            $folder = new FolderDestroyUseCase;
            $folder->folderDestroy($request);

            return redirect()->route('memo.index');
        }else {
            return redirect()->route('memo.index');
        }
    }
}
