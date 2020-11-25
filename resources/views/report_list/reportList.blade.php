@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="row d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active font-weight-bold text-primary" aria-current="page">List</li>
                <li class="breadcrumb-item" aria-current="page">Ditail</li>
                <li class="breadcrumb-item" aria-current="page">Edit</li>
                <li class="breadcrumb-item" aria-current="page">Edit Finish</li>
            </ol>
        </nav>
        <div class="row">
            <h1 class="display-5 text-secondary font-weight-lighter">
                Report List
            </h1>
        </div>

        <div class="row font-weight-bold h5">
            絞り込み機能<br>
        </div>

        <form action="narrow" method="POST">
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col-4">
                    <label class="">報告書タイトル:</label>
                    <input class="form-control" name="title" type="text" value="{{ old('title', isset($title) ? $title : '') }}"　placeholder="タイトル検索文言"/>
                </div>
                <div class="form-group col-4">
                    <label class="">報告書内容:</label>
                    <input class="form-control" name="body" type="text" value="{{ old('body', isset($body) ? $body : '') }}" placeholder="本文検索文言"/>
                </div>
            </div>
                <div class="m-4 clearfix float-right">
                    <a href="{{ url('/list') }}" role="button" class="links btn btn-outline-info">クリア</a>
                </div>
                <div class="my-4 clearfix float-right">
                    <button class="btn btn-outline-info" name="narrow"> 絞り込み </button>
                </div>
        </form>

        <form action="detail" method="POST">
        <table class="table" style="table-layout:fixed;">
            <thead class="thead-light">
                <th class="back1 " scope="col" style="white-space:nowrap; width:20%;">
                    @sortablelink('title', '報告書タイトル')
                </th>
                <th style="width:37%;">報告書</th>
                <th class="back1 " scope="col" style="white-space:nowrap;  width:15%;">
                    @sortablelink('user_name', '投稿者')
                </th>
                <th style="width:14%;">
                    @sortablelink('created_at', '登録日時')
                </th>
                <th style="width:6%;" class="text-center">添付</th>
                <th style="width:8%;"></th>
            </thead>
            <tbody>
                @foreach($reportList as $report)
                        {{ csrf_field() }}
                        <tr>
                            <td>{{$report['title']}}</td>
                            <td>{!! nl2br(e(Str::limit($report['body'],100))) !!}</td>
                            <td>{{$report['user_name']}}</td>
                            <td>{{$report['created_at']->format('Y/m/d H:i')}}</td>
                            <td>
                                @if($report['attachment_flg'])
                                    <p style="color: gray; font-size: 20px;" class="text-center">
                                        <i class="far fa-file"></i>
                                    </p>
                                @endif
                            </td>
                            <td><button class="btn btn-outline-success" name="detail" type="submit" value="{{$report['id']}}"> 詳細 </button></td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        </form>
        <div class="">
            <a href="{{ url('/') }}" role="button" class="links btn btn-outline-info btn-lg">TOPへ</a>
        </div>
    </div>
@endsection
