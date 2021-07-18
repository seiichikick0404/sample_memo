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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // フォルダ選択
    public function select(Request $request, FolderSelectUseCase $folder )
    {
        // $folder = new FolderSelectUseCase;
        // フォルダー選択処理
        $folder->FolderSelect($request);

        return redirect()->route('memo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $folder->FolderCreate($request);
            return redirect('/memo');

        }else {
            return redirect('/memo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // フォルダ編集処理
    public function edit(Request $request)
    {
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
            $folder->FolderUpdate($request);
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
            $folder->FolderDestroy($request);

            return redirect()->route('memo.index');
        }else {
            return redirect()->route('memo.index');
        }
    }
}
