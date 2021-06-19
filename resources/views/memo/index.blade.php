@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row memo-container">
        <div class="folder-bar col-2">

            <!-- リスト表示 -->
            <div class="list-group ">
            @foreach ($folders as $folder)
                @if (mb_strlen($folder->folder_name) <= 11)
                    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="far fa-folder"></i>{{ $folder->folder_name }}</a>
                @else 
                    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="far fa-folder"></i>{{ mb_substr($folder->folder_name, 0, 11)."..." }}</a>
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
                        <h5 class="modal-title" id="Modal">フォルダ作成</h5>
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

        
        <div class="file-bar col-2">
        </div>
        <div class="main-content col-8">

        </div>
    </div>
</div>
@endsection