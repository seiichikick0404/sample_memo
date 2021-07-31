<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Memo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\GetNewMemo;
use App\UseCase\UseFolder\FolderGetUseCase;
use App\UseCase\UseMemo\MemoGetUseCase;
use App\UseCase\UseMemo\MemoSelectUseCase;
use App\UseCase\UseMemo\MemoCreateUseCase;
use App\UseCase\UseMemo\MemoUpdateUseCase;
use App\UseCase\UseMemo\MemoDestroyUseCase;
use App\UseCase\UseMemo\MemoLockUseCase;
use App\UseCase\UseMemo\MemoLockCloseUseCase;
use App\UseCase\UseMemo\MemoLockReleaseUseCase;
use App\UseCase\UseMemo\MemoLockDestroyUseCase;

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
    public function memo_lock_release(Request $request, MemoLockReleaseUseCase $memo){


        $memo->memoRelease($request);

        return redirect()->route('memo.index');

    }

    // メモロック 解除(ロックそのものを解除)
    public function memo_lock_destroy(Request $request, MemoLockDestroyUseCase $memo){

        $memo->lockDestroy($request);

        return redirect()->route('memo.index');
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

        return redirect()->route('memo.index');
    }

}
