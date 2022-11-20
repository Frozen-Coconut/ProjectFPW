@extends('layout.main')

@section('head')
<link rel="stylesheet" href="{{asset('css/user-sidebar.css')}}">

@yield('js')

@endsection

@section('body')
<div class="min-h-screen bg-gray-50 flex">
    @include('user.util.sidebar_main')
    <div class="w-full h-screen">
        @yield('content')
    </div>
</div
@endsection
