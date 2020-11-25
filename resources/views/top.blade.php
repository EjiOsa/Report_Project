@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5"><h1 class="display-5"></h1></div>
        <div class="row mt-5"><h1 class="display-5"></h1></div>
        <div class="row mt-5"><h1 class="display-5"></h1></div>

        <div class="row justify-content-center mt-5">
            <h1 class="display-4 text-secondary font-weight-lighter">
                Report Create&View TOP
            </h1>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col">
                <form action="create" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-outline-success btn-lg float-right"> Create Report </button>
                </form>
            </div>
            <div class="col">
                <form action="list" method="GET">
                    <button class="btn btn-outline-success btn-lg">Report List</button>
                </form>
            </div>
        </div>
    </div>
@endsection
