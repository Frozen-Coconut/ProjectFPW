@extends('admin.layouts.layout_main')
@section('content')
@include('util.message')
@if (session('message_error'))
    <div class="w-full bg-red-200 rounded">{{session('message_error')}}</div>
@elseif (session('message_success'))
    <div class="w-full bg-green-200 rounded">{{session('message_success')}}</div>
@endif

<div class="w-full place-content-center flex drop-shadow-sm  justify-center items-center h-screen">
    <div class="w-6/12 flex-col">
        <form action="" method="POST" class="border-solid border-gray-300 border rounded-lg p-10">
            <h1 class="text-xl pb-5">Add User</h1>
            @csrf
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                  Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email" value="{{old('email')}}" type="text" placeholder="Email">
                @error('email')
                <p class="text-red-500">{{$message}}</p>
                @enderror
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                  Nama Lengkap
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" value="{{old('email')}}" type="text" placeholder="Nama Lengkap">
                @error('name')
                <p class="text-red-500">{{$message}}</p>
                @enderror
              </div>
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                  Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password" type="password" placeholder="Password">
                @error('password')
                <p class="text-red-500">{{$message}}</p>
                @enderror
              </div>
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                  Konfirmasi Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" type="password" placeholder="Konfirmasi Password">
                @error('password_confirmation')
                <p class="text-red-500">{{$message}}</p>
                @enderror
              </div>
              <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="register">
                  Tambah User
                </button>
              </div>
            </form>
        </div>
</div>
@endsection
