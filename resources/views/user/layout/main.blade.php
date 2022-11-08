@extends('layout.main')

@section('head')
<link rel="stylesheet" href="{{asset('css/user-sidebar.css')}}">
@endsection

@section('body')
<div class="min-h-screen bg-gray-100 flex">
    @include('user.util.sidebar')
    <div class="w-full p-10">
        @yield('content')
    </div>
</div
@endsection
