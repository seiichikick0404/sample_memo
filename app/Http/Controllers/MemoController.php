<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\GetNewMemo;
use App\UseCase\UseFolder\FolderGetUseCase;
use App\UseCase\UseMemo\MemoGetUseCase;
use App\UseCase\UseMemo\MemoSelectUseCase;
use App\UseCase\UseMemo\MemoCreateUseCase;
use App\UseCase\UseMemo\MemoUpdateUseCase;
use App\UseCase\UseMemo\MemoDestroyUseCase;
use App\UseCase\UseMemo\MemoLockUseCase;
use App\UseCase\UseMemo\MemoLockCloseUseCase;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FolderGetUseCase $folder)
    {

        // 認証ユーザー名取得
        $user = Auth::user();

        // 選択中のフォルダ取得
        $select_folder = session()->get('select_folder');

        // 親フォルダの取得
        $parent_folder = session()->get('parent_folder');

        // 選択中のメモ取得
        $select_memo = session()->get('select_memo');

        // フォルダ一覧取得
        $folders = $folder->getFolder($user);


        // メモ一覧取得(全てのメモ)
        if ($parent_folder == 'all'){
            $memo = new MemoGetUseCase;
            $memos = $memo->getAllMemo($user);

        }
        // メモ一覧取得(フォルダに属する)
        elseif (isset($select_folder) && $parent_folder == ''){
            $memo = new MemoGetUseCase;
            $memos = $memo->parentFolder($select_folder);

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

    // メモ選択機能
    public function select_memo(Request $request, MemoSelectUseCase $memo)
    {
        $memo->selectMemo($request);

        return redirect()->route('memo.index');
    }

    // メモロック 施錠
    public function memo_lock(Request $request, MemoLockUseCase $memo){

        $memo->memoLock($request);

        return redirect()->route('memo.index');

    }

    // メモロック 閉じる(再び施錠)
    public function memo_lock_close(Request $request, MemoLockCloseUseCase $memo){

        $memo->memoClose($request);

        return redirect()->route('memo.index');
    }

    // メモロック 解除
    public function memo_lock_release(Request $request){


        // 認証ユーザーの取得
        $user = Auth::user();

        // 選択されたメモid取得
        $memo_id = $request->input('memo_id');

        // 入力されたパスワード取得
        $input_password = $request->input('memo_password');

        // パスワード認証チェック
        if (Hash::check($input_password, $user->password)){
            // 認証成功
            DB::table('memos')
            ->where('memo_id', $memo_id)
            ->update(['key_lock_status'=> 'true']);
        }

        // 選択中メモ セッション更新
        $memo = DB::table('memos')
        ->where('memo_id', $memo_id)
        ->first();

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
    public function store(Request $request, MemoCreateUseCase $memo_create)
    {
        $memo_create->memoCreate($request);

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
    public function update(Request $request, MemoUpdateUseCase $memo_update)
    {
        // メモ更新処理
        $memo_update->memoUpdate($request);

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
    public function destroy(Request $request, MemoDestroyUseCase $memo)
    {
        // 削除
        $memo->MemoDestroy($request);

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
