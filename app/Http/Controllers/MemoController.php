<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //フォルダ一覧表示
        if (auth::check()){
            //認証ユーザーのid取得
            $user_id = Auth::id();

            //認証ユーザー名取得
            $user = Auth::user();
            $user_name = $user->name;

            // 選択中のフォルダ取得
            $select_folder = session()->get('select_folder');

            // 選択中のメモ取得
            $select_memo = session()->get('select_memo');

            // dd($select_memo);

            // フォルダ一覧取得
            $folders = DB::table('folders')
            ->select('folder_name', 'folder_id')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

            // メモ一覧取得
            $memos = DB::table('memos')
            ->where('folder_id', $select_folder->folder_id)
            ->orderBy('created_at', 'desc')
            ->get();

            // dd($memos);            
            // dd($select_folder->folder_id);
            
            return view('memo.index', ['folders'=> $folders,
                                       'select_folder'=> $select_folder,
                                       'user_name'=> $user_name,
                                       'memos' => $memos,
                                       'select_memo' => $select_memo,
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

        // dd($memo);

        session()->put('select_memo', $memo);

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
        // dd($memo);
        $memo->save();

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
