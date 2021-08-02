@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row memo-container">
        <div class="folder-bar col-3">
            <div class="folder-bar-header">
                <div class="row align-items-center">
                    <div class="col-9 user-name-box">
                        {{ $user->name }}さんお帰りなさい
                    </div>
                    <div class="col-3 folder-bar-nav">
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('memo.logout') }}'"><i class="fas fa-sign-out-alt"></i></button>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">フォルダ名変更</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('memo.update_folder') }}" id="folder_edit_form" method="POST">
                        @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">フォルダ名</label>
                                <input type="hidden" name="folder_id" class="form-control" id="edit_id" aria-describedby="emailHelp">
                                <input type="text" name="folder_name" class="form-control" id="edit_folder" aria-describedby="emailHelp">
                            </div>
                        </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <button type="submit" form="folder_edit_form" class="btn btn-primary">保存する</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- リスト表示 -->
            <h2 class="folder-title">フォルダリスト</h2>
            <div class="list-group">

            <li class="list-group-item list-group-item-action @if ($parent_folder) active  @endif " >
                <a href="{{ route('memo.select_all_folder') }}?key=all" class="@if ($parent_folder) active  @endif " >
                    <i class="far fa-folder"></i>
                    全てのファイル
                </a>
            </li>
            @foreach ($folders as $folder)
            @if (mb_strlen($folder->folder_name) <= 11)
                <li class="list-group-item list-group-item-action @if ($select_folder AND $select_folder->folder_id == $folder->folder_id AND $parent_folder == NULL) active @endif  ">
                    <a href="{{ route('memo.select_folder') }}?id={{ $folder->folder_id }}" class="@if ($select_folder AND $select_folder->folder_id == $folder->folder_id AND $parent_folder == NULL) active @endif " >
                        <i class="far fa-folder"></i>
                        {{ $folder->folder_name }}
                    </a>
                    <!-- モダール用ボタン -->
                    <button type="button" class="btn btn-primary edit-position" data-toggle="modal" data-target="#exampleModal" data-id="{{ $folder->folder_id  }}" data-name="{{ $folder->folder_name }}"><i class="fas fa-save"></i></button>
                    <button type="button" class="btn btn-danger delete-position" onclick="location.href='{{ route('memo.destroy_folder', ['id' => $folder->folder_id]) }}'"><i class="fas fa-trash-alt"></i></button>
                    <!-- モーダル部分始まり -->
                </li>
            @else
                <li class="list-group-item list-group-item-action @if ($select_folder AND $select_folder->folder_id == $folder->folder_id AND $parent_folder == NULL) active @endif   ">
                    <a href="{{ route('memo.select_folder') }}?id={{ $folder->folder_id }}" class="@if ($select_folder AND $select_folder->folder_id == $folder->folder_id AND $parent_folder == NULL) active @endif " >
                        <i class="far fa-folder"></i>
                        {{ mb_substr($folder->folder_name, 0, 11)."..." }}
                    </a>
                    <!-- モーダル用ボタン -->
                    <button type="button" class="btn btn-primary edit-position" data-toggle="modal" data-target="#exampleModal" data-id="{{ $folder->folder_id  }}" data-name="{{ $folder->folder_name }}"><i class="fas fa-save"></i></button>
                    <button class="btn btn-danger delete-position" onclick="location.href='{{ route('memo.destroy_folder') }}?id={{ $folder->folder_id }}'"><i class="fas fa-trash-alt"></i></button>
                    <!-- モーダル部分始まり -->
                </li>
            @endif
            @endforeach

            </div>

            <!-- 切り替えボタンの設定 -->
            <button type="button" class="btn btn-primary modal-btn" data-toggle="modal" data-target="#Modal">
                新規フォルダ作成
            </button>

            <!-- モーダルの設定 -->

            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
                <!--以下modal-dialogのCSSの部分で modal-lgやmodal-smを追加するとモーダルのサイズを変更することができる-->
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Modal">フォルダ名を入力してください</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('memo.create_folder') }}" id="folder_form" method="POST">
                    @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">フォルダ名</label>
                            <input type="text" name="folder_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <button type="submit" form="folder_form" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
        </div>

        </div>


        <div class="file-bar col-3">
            <div class="button-wrap">
                @if ($select_folder AND $select_memo)
                    <button type="submit" class="btn btn-danger"  onclick="location.href='{{ route('memo.destroy_memo', ['id'=> $select_memo->memo_id ]) }}'" formaction=""><i class="fas fa-trash-alt"></i></button>
                    <button type="submit" class="btn btn-primary" onclick="location.href='{{ route('memo.create_memo', ['id'=> $select_folder->folder_id ]) }}'" formaction=""><i class="far fa-edit"></i></button>
                @elseif ($select_folder)
                    <button type="submit" class="btn btn-danger"  formaction=""><i class="fas fa-trash-alt"></i></button>
                    <button type="submit" class="btn btn-primary" onclick="location.href='{{ route('memo.create_memo', ['id'=> $select_folder->folder_id ]) }}'" formaction=""><i class="far fa-edit"></i></button>
                @else
                    <button type="submit" class="btn btn-danger" formaction=""><i class="fas fa-trash-alt"></i></button>
                    <button type="submit" class="btn btn-primary" formaction=""><i class="far fa-edit"></i></button>
                @endif
            </div>

            <ul class="list-group list-group-flush">
            @if ($select_folder AND $folders AND count($memos) >= 1)
                @foreach ($memos as $memo)
                <a href="{{ route('memo.select_memo', ['id' => $memo->memo_id]) }}" class="list-group-item @if ($select_memo) {{ $select_memo->memo_id == $memo->memo_id ? 'active' : '' }} @endif" >
                    {{ $memo->title }}
                <p class="memo_date">{{$memo->created_at}}</p>
                </a>
                @endforeach

            @elseif ($select_folder === NUll)
                @foreach ($memos as $memo)
                    <a href="{{ route('memo.select_memo', ['id' => $memo->memo_id]) }}" class="list-group-item @if ($select_memo) {{ $select_memo->memo_id == $memo->memo_id ? 'active' : '' }} @endif" >
                        {{ $memo->title }}
                    <p class="memo_date">{{$memo->created_at}}</p>
                    </a>
                @endforeach

            @else
                <i class="fas fa-info-circle"></i>メモを新規作成するかフォルダを選択してください。
            @endif
            </ul>
        </div>
        <div class="main-content col-6">
            <div class="row">
                <div class="col-12 h-100">
                    <!-----ここから追加する----->


                    @if ($select_memo AND $select_memo->key_flag == NULL)
                    <form class="w-100 h-100" action="" method="post">
                        @csrf
                        <input type="hidden" name="edit_id" value="{{ $select_memo->memo_id }}" />
                        <div id="memo-menu" class="memo-wrap">
                            <button type="submit" class="btn btn-success save-btn" formaction="{{ route('memo.update_memo') }}"><i class="fas fa-save"></i></button>
                            <button type="button" class="btn btn-primary lock-btn" onclick="location.href='{{ route('memo.lock', ['id'=> $select_memo->memo_id ]) }}'"><i class="fas fa-lock"></i></button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary search" data-toggle="modal" data-target="#modal_search"><i class="fas fa-search"></i></button>
                        </div>
                        <input type="text" id="memo-title" name="edit_title" value={{ $select_memo->title }} placeholder="タイトルを入力する..." />
                        <textarea id="memo-content" name="edit_content" placeholder="内容を入力する...">{{ $select_memo->text }}</textarea>
                    </form>

                    @elseif ($select_memo AND $select_memo->key_flag == 'true' AND $select_memo->key_lock_status == 'false')
                    <form class="w-100 h-100" action="{{ route('memo.lock_release') }}" method="post">
                        @csrf
                        <input type="hidden" name="memo_id" value="{{ $select_memo->memo_id }}" />
                        <div id="memo-menu" class="memo-wrap">
                            <button type="submit" class="btn btn-success save-btn" formaction="{{ route('memo.update_memo') }}"><i class="fas fa-save"></i></button>
                            <button type="button" class="btn btn-primary lock-btn" onclick="location.href='{{ route('memo.lock_destroy', ['id'=> $select_memo->memo_id ]) }}'"><i class="fas fa-slash" style="font-size: 10px;"></i></button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary search" data-toggle="modal" data-target="#modal_search"><i class="fas fa-search"></i></button>
                        </div>
                        <P><i class="fas fa-lock"></i></p>
                        <h2>このメモはロックがかけられています</h2>
                        <input type="password" id="memo-title" name="memo_password" value='' placeholder="パスワードを入力" />
                        <button type="submit" class="btn btn-secondary">ロック解除</button>
                    </form>

                    @elseif ($select_memo AND $select_memo->key_flag == 'true' AND $select_memo->key_lock_status == 'true')
                    <form class="w-100 h-100" action="" method="post">
                        @csrf
                        <input type="hidden" name="edit_id" value="{{ $select_memo->memo_id }}" />
                        <div id="memo-menu" class="memo-wrap">
                            <button type="submit" class="btn btn-success save-btn" formaction="{{ route('memo.update_memo') }}"><i class="fas fa-save"></i></button>
                            <button type="button" class="btn btn-primary lock-btn" onclick="location.href='{{ route('memo.lock_close', ['id'=> $select_memo->memo_id ]) }}'"><i class="fas fa-lock-open"></i></button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary search" data-toggle="modal" data-target="#modal_search"><i class="fas fa-search"></i></button>
                        </div>
                        <input type="text" id="memo-title" name="edit_title" value={{ $select_memo->title }} placeholder="タイトルを入力する..." />
                        <textarea id="memo-content" name="edit_content" placeholder="内容を入力する...">{{ $select_memo->text }}</textarea>
                    </form>

                    @else
                    <div id="memo-menu" class="memo-wrap">
                    </div>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modal_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">メモ検索</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form id="search-memo" method="GET" action="{{ route('memo.search_memo') }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">検索</label>
                                    <input type="text" name="search" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="メモタイトル">
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="search-memo" class="btn btn-primary">検索</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection