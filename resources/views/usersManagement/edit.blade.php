
@extends('layouts.app')
@section('content')

    <div class="row justify-content-center mt-3">
        <div class="col-md-8">

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edit user
                    </div>
                    <div class="float-end">
                        <a href="{{ route('usersManagement.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                <form action="{{ route('usersManagement.update',$user->id  ) }} " method="post">
                        @csrf
                        @method("PUT")



                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>



                        <div class="mb-3 row">
                            <label for="description" class="col-md-4 col-form-label text-md-end text-start">Email</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('email') is-invalid @enderror" id="email" name="email">{{ $user->email }}</textarea>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    <div class="mb-3 row">
                        <label for="admin" class="col-md-4 col-form-label text-md-end text-start">Role</label>
                            <div class="col-md-6">
                                <select class="form-select " aria-label="Default select example" name="admin" id="admin">
                                    <option value="0" selected>Role</option>
                                    <option value="0">User</option>
                                    <option value="1">Editor</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                    </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                        </div>
                </form>



{{--@dump($user->postWriten)--}}
                        <table class="table table-striped table-bordered">
                            <tbody>

                            @forelse($user->postWriten as $post)
{{--                                @dump($post)--}}
                                <tr >
                                    <td style="display: flex;justify-content: center">
                                        <img src="{{asset('/storage/media/'.$post->imageFolder.'/'.$post->image)}}" class="card-img-top" alt="{{$post->image}}" style="height: 200px;width: auto ;max-width: 500px">
                                    </td>
                                    <td  >
                                        <div style="display: flex;justify-content: center;align-items: center;flex-direction: column">
                                            <a  class="link-primary btn" href="{{ route('posts.show', $post->id) }}"
                                                style="
                                              display:inline-block;
                                              white-space: nowrap;
                                              overflow: hidden;
                                              text-overflow: ellipsis;
                                              max-width: 20ch;"

                                            >
                                                {{ $post->title }}
                                            </a>

                                            <div class="text"> written by {{$post->writer->name}}</div>
                                            {{ @explode(' ',$post->created_at)[0]}}
                                            @if((Auth::user()->admin===1&&Auth::user()->id===$post->wroteBy)||Auth::user()->admin===2)

                                                <div>
                                                    <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')



                                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>

                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this post?');"><i class="bi bi-trash"></i> Delete</button>

                                                    </form>

                                                </div>
                                            @endIf
                                        </div>



                                    </td>

                                </tr>
                            @empty
                              <td colspan="6">
                                <span class="text-danger">
                                    <strong>User has no posts!</strong>
                                </span>
                                </td>

                            @endforelse
                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>

@endsection
