@extends('layouts.app')
@section('content')

        <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
                <div class="card container-fluid">
                <div class="card-header">post List</div>
                <div class="card-body">

                    @if(Auth::check() && Auth::user()->admin>=1)
                        <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New post</a>
                    @endif
                        @if(!Auth::check())
                            @include("posts.tableLogged",["posts"=>$posts])
                        @else
                            @include("posts.table",["posts"=>$posts,"user"=>Auth::user()])
                        @endif



                </div>

            </div>

        </div>
            <div class="card text-center">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                    <p class="card-text">{{ count($posts)}}
            {{$word=count($posts)===1?"post":"posts"
            }} written
{{--                    <p>Writter since:{{explode(' ',$user->created_at)[0]}}</p>--}}
                </div>

            </div>
    </div>

@endsection

