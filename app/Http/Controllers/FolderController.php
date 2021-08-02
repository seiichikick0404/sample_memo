<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\UseCase\UseFolder\FolderSelectUseCase;
use App\UseCase\UseFolder\FolderSelectAllUseCase;
use App\UseCase\UseFolder\FolderCreateUseCase;
use App\UseCase\UseFolder\FolderUpdateUseCase;
use App\UseCase\UseFolder\FolderDestroyUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\FolderRequest\FolderCreateRequest;
use App\Http\Requests\FolderRequest\FolderUpdateRequest;


final class FolderController extends Controller
{

    // フォルダ選択
    public function select(Request $request, FolderSelectUseCase $folder)
    {
        // フォルダー選択処理
        $folder->folderSelect($request);

        return redirect()->route('memo.index');
    }


    // フォルダ選択 (全ファイルフォルダ選択の場合)
    public function select_all_folder (Request $request, FolderSelectAllUseCase $folder){

        if ($request->key === 'all'){
            $folder->folderSelectAll($request);
        }

        return redirect()->route('memo.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FolderCreateUseCase $folder, FolderCreateRequest $request)
    {
        // バリデーション済みリクエスト取得
        $validated_request = $request->validated();

        //フォルダ作成処理
        $folder->folderCreate($validated_request);

        return redirect('/memo');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FolderUpdateRequest $request , FolderUpdateUseCase $folder)
    {

        // バリデーション済みリクエスト取得
        $validated_request = $request->validated();

        $folder->folderUpdate($validated_request);

        return redirect('/memo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, FolderDestroyUseCase $folder)
    {
        // $requestがあった場合
        if ($request){
            $folder->folderDestroy($request);
        }

        return redirect()->route('memo.index');
    }
}
