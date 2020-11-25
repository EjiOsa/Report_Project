@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="row d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">List</li>
                <li class="breadcrumb-item active font-weight-bold text-primary" aria-current="page">Ditail</li>
                <li class="breadcrumb-item" aria-current="page">Edit</li>
                <li class="breadcrumb-item" aria-current="page">Edit Finish</li>
            </ol>
        </nav>
        <div class="row">
            <h1 class="display-5 text-secondary font-weight-lighter">
                Report Detail
            </h1>
        </div>

        <h2 class="row justify-content-center">報告書</h2>
        <div class="container">
            <div class='row'>
                <div class="col-9"></div>
                <label class="col-1 align-items-end">登録日時:</label>
                <p class="text-justify">{{$reportDetail['created_at']->format('Y/m/d H:i')}}</p>
            </div>

            <div class='row'>
                <label class="col-2 align-items-end">報告書タイトル:</label>
                <p class="text-justify font-weight-bold h3">{{$reportDetail['title']}}</p>
            </div>

            <hr class="my-1">
            <div class='row'>
                <label class="col-2 mt-4">報告書内容:</label>
                <p class="text-justify mt-4 text-break">{!! nl2br($reportDetail['body']) !!}</p>
            </div>

            <hr class="my-5">
            @if($attachments)
                @foreach($attachments as $attachment)
                    <form action="download" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="d-flex align-items-center col-3">ファイル名：{{$attachment['file_name']}}</div>
                            <a class="col-2 align-items-center d-flex align-items-center" href="{{url('storage/attachment/img')."/".basename($attachment['path'])}}" target="_blank">添付ファイルを表示</a>
                            <div><a class="btn btn-outline-secondary" role="button" href="{{url('storage/attachment/img')."/".basename($attachment['path'])}}" download="{{$attachment['file_name']}}">{{$attachment['file_name']}}をダウンロード</a></div>
                        </div>
                        <br>
                    </form>
                @endforeach
            @endif
            <br>

            <div class='row'>
                <div class='col-9'></div>
                <label class="col-1">報告者:</label>
                <p class="text-justify font-weight-bold text-center h5">{{$reportDetail['user_name']}}</p>
            </div>
        </div>
        <div class="links">
            <a href="javascript:history.back()" role="button" class="links btn btn-outline-info btn-lg">Back</a>
        </div>
    </div>
@endsection
