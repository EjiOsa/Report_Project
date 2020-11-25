@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="row d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">Create</li>
                <li class="breadcrumb-item" aria-current="page">Confirm</li>
                <li class="breadcrumb-item active font-weight-bold text-primary" aria-current="page">Finish</li>
            </ol>
        </nav>
        <div class="row">
            <h1 class="display-5 text-secondary font-weight-lighter">
                Create Finish
            </h1>
        </div>
        <div class="row mt-5"><h1 class="display-5"></h1></div>
        <div class="row mt-5"><h1 class="display-5"></h1></div>
        <div class="row mt-5"><h1 class="display-5"></h1></div>

        <div class="row text-justify text-center h5 justify-content-center">
            報告書の登録が完了しました。
        </div>

        <div class="row justify-content-center">
            <a class="links btn btn-outline-primary btn-lg float-center" href="{{ url('/') }}">TOPへ戻る</a>
        </div>
    </div>
@endsection
