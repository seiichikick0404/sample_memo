<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class FolderController extends Controller
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
    public function select(Request $request)
    {
        // 全てのファイルフォルダが選択された場合
        if ($request->key ){
            $user = Auth::user();
            $parent_folder = $request->key;

            session()->put('parent_folder', $parent_folder);

            $memo = DB::table('memos')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
            session()->put('select_memo', $memo);

        }
        // 通常処理(フォルダ選択の場合)
        else {
            // フォルダ セッション更新
            $id = $request->id;
            $folder = DB::table('folders')
            ->where('folder_id', $id)
            ->first();
            session()->put('select_folder', $folder);

            // メモ セッション更新
            $memo = DB::table('memos')
            ->where('folder_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
            session()->put('select_memo', $memo);

            session()->remove('parent_folder');
        }



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
    public function store(Request $request)
    {
        // ログイン済み かつ POSTの場合
        if (auth::check() && $request){
            $folder = new Folder;

            // ログイン中のユーザーid取得
            $user_id = Auth::id();

            // フォルダ登録処理
            $folder->folder_name = $request->input('folder_name');
            $folder->user_id = $user_id;
            
            $folder->save();

            // フォルダ セッション更新
            $folder = DB::table('folders')
            ->where('folder_id', $folder->folder_id)
            ->first();
            session()->put('select_folder', $folder);
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
            $folder = new Folder;

            $int_edit_id = $request->input('folder_id');
            // 数値に変換
            $edit_id = (int) $int_edit_id;
            $edit_name = $request->input('folder_name');

             //ログイン中のユーザーid取得
            $user_id = Auth::id();

            $folder = DB::table('folders')
            ->where('folder_id', $edit_id)
            ->update(['folder_name'=> $edit_name]);

            
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
        $folder = new Folder;
        $folder = DB::table('folders')
        ->where('folder_id', $request->id)
        ->delete();

        return redirect()->route('memo.index');
    }
}
