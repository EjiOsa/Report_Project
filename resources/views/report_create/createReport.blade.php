@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="row d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active font-weight-bold text-primary" aria-current="page">Create</li>
                <li class="breadcrumb-item" aria-current="page">Confirm</li>
                <li class="breadcrumb-item" aria-current="page">Finish</li>
            </ol>
        </nav>
        <div class="row">
            <h1 class="display-5 text-secondary font-weight-lighter">
                Create Report
            </h1>
        </div>

        {{-- エラーメッセージエリア --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <h4>エラーメッセージ</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 入力フォームエリア --}}
        <h2 class="row justify-content-center">報告書作成</h2>
        <form action="create/confirm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-form-label-lg font-weight-bold">報告書タイトル</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title">
            </div>
            <div class="form-group">
                <label class="col-form-label-lg font-weight-bold">報告内容</label>
                <textarea class="form-control @error('body') is-invalid @enderror" rows="10" name="body"></textarea>
            </div>
            {{-- ファイル選択部分  --}}
            <div class="form-group">
                <label class="control-label font-weight-bold">添付（複数可）</label>
                <input type="file" id="file" name="attachment[]" class="form-control-file" multiple>
            </div>
            {{ csrf_field() }}
            <button class="btn btn-outline-primary btn-lg float-right" name="confirm">確認</button>
        </form>
        <form action="./" method="GET">
            <button class="btn btn-outline-primary btn-lg">戻る</button>
        </form>
    </div>
@endsection
