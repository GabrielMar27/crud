
@extends('layouts.app')
@section('content')
    @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif
<form action="{{route('subscribe.store',$user)}}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Subscribe</button>
</form>
@endsection
