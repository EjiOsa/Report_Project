@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="row d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">Create</li>
                <li class="breadcrumb-item active font-weight-bold text-primary" aria-current="page">Confirm</li>
                <li class="breadcrumb-item" aria-current="page">Finish</li>
            </ol>
        </nav>
        <div class="row">
            <h1 class="display-5 text-secondary font-weight-lighter">
                Confirm Report
            </h1>
        </div>

        {{-- 投稿確認エリア --}}
        <h2 class="row justify-content-center">報告書</h2>
        <div class="row mt-5"><h1 class="display-5"></h1></div>
        <div class="container">
            <div class='row'>
                <label class="col-2 align-items-end">報告書タイトル:</label>
                <p class="text-justify font-weight-bold h3">{{ Session::get('title_ses') }}</p>
            </div>

            <hr class="my-1">
            <div class='row'>
                <label class="col-2 mt-4">報告書内容:</label>
                <p class="text-justify mt-4 text-break">{!! nl2br(Session::get('body_ses')) !!}</p>
            </div>

            <hr class="my-5">

            @if(Session::get('attachment_array'))
                @foreach(Session::get('attachment_array') as $attachment)
                    <div class="row">
                        <div class="d-flex align-items-center">ファイル名：{{$attachment['file_name']}}</div>
                        <a class="col-3 align-items-center d-flex align-items-center" href="{{url('storage/attachment/img/tmp')."/".$attachment['new_image_name']}}" target="_blank">アップロードファイルを表示</a>
                        <button class="btn btn-outline-secondary float-right js-attachment-delete" name="delete" value="{{$attachment['new_image_name']}}"> {{$attachment['file_name']}}を削除 </button>
                    </div>
                    <br>
                @endforeach
            @endif
            <br>

            <div class='row'>
                <div class='col-9'></div>
                <label class="col-1">報告者:</label>
                <p class="text-justify font-weight-bold text-center h5">{{ Session::get('name_ses') }}</p>
            </div>
        </div>
                <form action="finish" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-outline-primary btn-lg float-right" name="insert"> 登録 </button>
                </form>
                <div>
                    <a href="javascript:history.back()" role="button"
                    class="links btn btn-outline-primary btn-lg">戻る</a>
                </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let attachment_delete = $('.js-attachment-delete');
        let attachment_name;
        attachment_delete.on('click', function () {
            var deleteConfirm = confirm('添付ファイルを削除してよろしいでしょうか？');
                if(deleteConfirm == true) {
                var $this = $(this);
                attachment_name = $this.attr('value');
                $.ajax({
                    url: 'ajax/attachment',
                    type: 'POST',
                    data: {
                        'attachment_name': attachment_name
                    },
                })
                // Ajaxリクエストが成功した場合
                .done(function (data) {
                    $this.parent().next('br').remove();
                    $this.parent().remove();
                })
                // Ajaxリクエストが失敗した場合
                .fail(function (data, xhr, err) {
                    alert("ajax fail");
                    console.log('エラー');
                    console.log(err);
                    console.log(xhr);
                });
            return false;
                }
            });
        });
    </script>
@endsection
