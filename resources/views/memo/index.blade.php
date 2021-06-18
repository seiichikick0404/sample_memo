@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="folder-bar col-2">
            <!-- 切り替えボタンの設定 -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal">
                押すと表示されます。
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
                <form action="" name="folder_form" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">フォルダ名</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="button" name="folder_form" class="btn btn-primary">保存</button>
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
    <button type="button" class="btn btn-primary">Primary</button>
    <button type="button" class="btn btn-secondary">Secondary</button>
    <button type="button" class="btn btn-success">Success</button>
    <button type="button" class="btn btn-danger">Danger</button>
    <button type="button" class="btn btn-warning">Warning</button>
    <button type="button" class="btn btn-info">Info</button>
    <button type="button" class="btn btn-light">Light</button>
    <button type="button" class="btn btn-dark">Dark</button>

</div>
@endsection