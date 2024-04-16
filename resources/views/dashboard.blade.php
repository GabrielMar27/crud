@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(Auth::user()->admin===2)
                        <h1>You are logged in as admin!</h1>
                    @elseif(Auth::user()->admin===1)
                        <h1>Hello Editor!</h1>
                    @else
                        <h1> Hello User</h1>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection
