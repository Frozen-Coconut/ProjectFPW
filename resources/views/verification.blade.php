@extends('layout.main')

@section('body')
@include('util.message')
@if (session('message_error'))
    <div class="w-full bg-red-200 rounded">{{session('message_error')}}</div>
@elseif (session('message_success'))
    <div class="w-full bg-green-200 rounded">{{session('message_success')}}</div>
@endif

<div class="w-full place-content-center flex drop-shadow-sm  justify-center items-center h-screen">
    <div class="w-6/12 flex-col">
        <form action="{{route('do_verifikasi')}}" method="POST" class="border-solid border-gray-300 border rounded-lg p-10">
        @csrf
        <input type="hidden" name="email" value="{{$email}}">
        <h1 class="text-xl pb-5">Verifikasi</h1>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Kode Verifikasi
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="kode_verif" type="text" placeholder="Kode Verifikasi">
        </form>
    </div>
</div>
@endsection
