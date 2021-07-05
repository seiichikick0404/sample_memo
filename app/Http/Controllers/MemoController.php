<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\GetNewMemo;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //フォルダ一覧表示
        if (auth::check()){

            //認証ユーザー名取得
            $user = Auth::user();

            // メモにロックをかけていた場合
            if ($request->input('memo_key')){
                $memo_status = 'lock';

                dd($memo_status);
            }

            // 選択中のフォルダ取得
            $select_folder = session()->get('select_folder');

            // 親フォルダの取得
            $parent_folder = session()->get('parent_folder');

            // 選択中のメモ取得
            $select_memo = session()->get('select_memo');

            // フォルダ一覧取得
            $folders = DB::table('folders')
            ->select('folder_name', 'folder_id')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();


            // メモ一覧取得(全てのメモ)
            if ($parent_folder == 'all'){
                $memos = DB::table('memos')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            }
            // メモ一覧取得(フォルダに属する)
            elseif (isset($select_folder) && $parent_folder == ''){
                $memos = DB::table('memos')
                ->where('folder_id', $select_folder->folder_id)
                ->orderBy('created_at', 'desc')
                ->get();

            }else {
                $memos = 'no_object';
            }


            return view('memo.index', ['folders'=> $folders,
                                       'select_folder'=> $select_folder,
                                       'user'=> $user,
                                       'memos' => $memos,
                                       'select_memo' => $select_memo,
                                       'parent_folder' =>  $parent_folder,
                                      ]);
        }
    }

    // メモ選択機能
    public function select_memo(Request $request)
    {
        //メモid取得
        $id = $request->id;
        $memo = DB::table('memos')
        ->where('memo_id', $id)
        ->first();

        session()->put('select_memo', $memo);

        return redirect()->route('memo.index');
    }

    // メモロック機能
    public function memo_lock(Request $request){

        //認証ユーザ取得
        $user = Auth::user();

        // メモidの取得
        $id = $request->id;


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
        $memo = new Memo;

        // ログイン中のユーザーid取得
        $user_id = Auth::id();

        // 選択中のフォルダidを取得
        $folder_id = $request->id;

        // 新規メモ作成
        $memo->title = '新規メモ';
        $memo->text = NUll;
        $memo->user_id = $user_id;
        $memo->folder_id = $folder_id;
        $memo->save();

        // 新規メモ取得
        $session_memo = GetNewMemo::GetMemo();

        // セッション更新
        session()->put('select_memo', $session_memo);
        return redirect()->route('memo.index');
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
    public function edit($id)
    {
        //
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

        $id = $request->edit_id;
        $title = $request->input('edit_title');
        $content = $request->input('edit_content');

        $memo = DB::table('memos')
        ->where('memo_id', $id)
        ->update(['title'=> $title, 'text'=> $content]);

        // 新規メモ取得
        $session_memo = GetNewMemo::GetMemo();

        // セッション更新
        session()->put('select_memo', $session_memo);

        return redirect()->route('memo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 削除
        $id = $request->id;
        DB::table('memos')
        ->where('memo_id', $id)
        ->delete();

        // 新規メモ取得
        $session_memo = GetNewMemo::GetMemo();

        // メモ セッション更新
        session()->put('select_memo', $session_memo);

        return redirect()->route('memo.index');
    }

    // メモ検索
    public function search(Request $request){

        //認証ユーザー名取得
        $user = Auth::user();
        $user_name = $user->name;

        // 検索された場合
        if ($request->input('search')){


            // フォルダ一覧取得
            $folders = DB::table('folders')
            ->select('folder_name', 'folder_id')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

            // 検索
            $query = $request->input('search');
            $memos = DB::table('memos')
            ->where('title', 'like', '%'.$query.'%')
            ->orderBy('created_at', 'desc')
            ->get();

            $select_folder = session()->remove('select_folder');
            $select_memo = session()->remove('select_memo');

            dd($memos);

            return view('memo.index', [

                                       'user_name'=> $user_name,
                                       'memos' => $memos,
                                       'folders' => $folders,
                                       'select_folder'=> $select_folder,
                                       'select_memo'=> $select_memo,
                                      ]);
        }
    }
}
