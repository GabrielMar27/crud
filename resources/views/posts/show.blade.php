
    @extends('layouts.app')
    @section('content')

        {{--    {{dd(asset("/storage/media/download.jpeg"))}}--}}
        <div style="display: flex;justify-content: center;align-items: center">
        <div class="card" style="width: 30rem;">
            <img src="{{asset('/storage/media/'.$post->imageFolder.'/'.$post->image)}}" class="card-img-top" alt="{{$post->image}}">
            <div class="card-body">
                <div class="Post-Data">
                    <div style="display: flex; justify-content: space-between" >
                        <h1 class="card-title"  >{{ $post->title}}</h1>
                    </div>
                    <p class="card-text">{{ $post->description }}</p>
                    <a href="{{ route('/') }}" class="btn btn-primary btn-sm">&larr; Back</a>

                </div>

                <div class="card" style="margin-top: 10px">
                    <div class="card-body">
                        <div style="font-size: 15px"><a href="{{route('posts.indexCreatedBy',$post->writer->id)}}">written by {{$post->writer->name}}</a></div>

                    </div>
                </div>
            </div>
        </div>
    @endsection



