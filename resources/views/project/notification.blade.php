@extends('project.layout.project')

@section('js')
    <script src="{{asset('js/jquery-notifikasi.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

@section('content')
    <div class="p-10 h-full">
        <div class="w-full flex flex-col">
            <div class="flex items-center">
                <p class="text-3xl mb-10">Notification</p>
            </div>
            <div id="layout-notifikasi" class="w-full flex-flex-row container overflow-y-auto">

            </div>
        </div>
    </div>
@endsection
