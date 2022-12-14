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
          @error('kode_verif')
                <p class="text-red-500">{{$message}}</p>
          @enderror
          <div class="flex items-center justify-between mt-3">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login">
              Verifikasi
              <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{route('kirim_email', [
                "email" => $email
            ])}}">
            </button>
              Kirim ulang email verifikasi !
            </a>
          </div>
        </form>
    </div>
</div>
@endsection
