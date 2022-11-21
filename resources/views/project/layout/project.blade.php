@extends('layout.main')

@section('head')
<link rel="stylesheet" href="{{asset('css/user-sidebar.css')}}">
<link href="{{asset('css/jquery-linedtextarea.css')}}" type="text/css" rel="stylesheet" />
<script src="{{asset('js/jquery-linedtextarea.js')}}"></script>
@yield('js')

@endsection

@section('body')
<div class="min-h-screen bg-gray-50 flex">
    @include('project.util.sidebar_project')
    <div class="w-full h-screen">
        @yield('content')
    </div>
</div
@endsection
