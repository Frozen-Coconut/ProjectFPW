@extends('layout.main')

@section('body')
@include('util.message')
@if (session('message_error'))
    <div class="w-full bg-red-200 rounded">{{session('message_error')}}</div>
@elseif (session('message_success'))
    <div class="w-full bg-green-200 rounded">{{session('message_success')}}</div>
@endif

<div class="w-full place-content-center flex drop-shadow-sm">
    <div class="w-6/12 flex-col mt-20">
        <form action="{{route('doRegister')}}" method="POST" class="border-solid border-gray-300 border rounded-lg p-10">
            <h1 class="text-xl pb-5">Register</h1>
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
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="occupational_status">Pekerjaan</label><br>
                <select name="occupational_status" id="occupational_status" class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-white leading-tight">
                    <option value="0" {{old('occupational_status') == '0' ? 'selected' : ''}}>Pelajar</option>
                    <option value="1" {{old('occupational_status') == '1' ? 'selected' : ''}}>Mahasiswa</option>
                    <option value="2" {{old('occupational_status') == '2' ? 'selected' : ''}}>Pekerja</option>
                    <option value="3" {{old('occupational_status') == '3' ? 'selected' : ''}}>Yang lainnya</option>
                </select><br>
                @error('occupational_status')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
              </div>

              <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="register">
                  Sign Up
                </button>
              </div>
              <div>
                <a class="inline-block align-baseline text-sm text-blue-500 hover:text-blue-800 mt-7" href="{{route('login')}}">
                    Have an account? Login now!
                  </a>
              </div>
            </form>
        </div>
</div>
@endsection
