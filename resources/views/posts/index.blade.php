
@extends('layouts.app')
@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endif

            <div class="card">
                <div class="card-header">post List</div>
                <div class="card-body">
                    @if(Auth::check())
                        @if(Auth::user()->admin>=1)
                        <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New post</a>
                        @endif
                    @endif

                        @if(!Auth::check())
                            @include("posts.tableLogged",["posts"=>$posts])
                        @else
                            @include("posts.table",["posts"=>$posts,"user"=>Auth::user()])
                        @endif

                </div>
            </div>
        </div>
    </div>

@endsection
