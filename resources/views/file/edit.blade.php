@extends('layout.main')

@section('head')
<link href="{{asset('css/jquery-linedtextarea.css')}}" type="text/css" rel="stylesheet" />
<script src="{{asset('js/jquery-linedtextarea.js')}}"></script>
@endsection

@section('body')
<div class="container w-screen min-h-screen px-4 py-20 relative">
    <textarea id="text" rows="24" class="w-full">Ini adalah contoh text...</textarea>

    <button type="button" id="back" class="w-20 h-10 border rounded bg-gray-500 text-white absolute top-4 left-4">Back</button>
    <button type="button" id="save" class="w-20 h-10 border rounded bg-blue-500 text-white absolute bottom-4 right-4">Save</button>
    <p id="name" class="h-10 leading-10 text-black text-lg absolute top-4 right-4">contoh_file.html</p>

    <script>
        $('#text').linedtextarea();
    </script>
</div>
@endsection
