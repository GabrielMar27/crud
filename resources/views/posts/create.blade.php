
@extends('layouts.app')
@section('content')


    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Add New post
                    </div>
                    <div class="float-end">
                        <a href="{{ route('/') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf



                        <div class="mb-3 row">
                            <label for="title" class="col-md-4 col-form-label text-md-end text-start">title</label>
                            <div class="col-md-6">
                                <input type="text" maxlength="60"form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-4 col-form-label text-md-end text-start">description</label>
                            <div class="col-md-6">
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}"></textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="title" class="col-md-4 col-form-label text-md-end text-start">title</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="../../../media/{{"image" }}">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add post">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
