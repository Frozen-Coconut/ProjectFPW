@extends('layout.main')

@section('head')
<link rel="stylesheet" href="{{asset('css/user-sidebar.css')}}">

@yield('js')

@endsection

@section('body')
<div class="min-h-screen bg-gray-50 flex">
    @include('admin.util.sidebar')
    <div class="w-full h-screen">
        @include('util.message')
        @yield('content')
    </div>
</div
@endsection
