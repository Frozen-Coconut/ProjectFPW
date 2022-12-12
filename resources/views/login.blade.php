@extends('layout.main')

@section('body')
@include('util.message')

<div class="w-full place-content-center flex drop-shadow-sm justify-center items-center h-screen">
    <div class="max-w-xs flex-col">
        <form action="{{route('doLogin')}}" method="POST" class="border-solid border-gray-300 border rounded-lg p-10">
            <h1 class="text-xl pb-5">Login</h1>
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
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                  Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password" type="password" placeholder="Password">
                @error('password')
                <p class="text-red-500">{{$message}}</p>
                @enderror
              </div>
              <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login">
                  Sign In
                  <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                </button>
                  Forgot Password?
                </a>
              </div>
              <div>
                <a class="inline-block align-baseline text-sm text-blue-500 hover:text-blue-800 mt-7" href="{{route('register')}}">
                    Don't have an account? Register now!
                  </a>
              </div>
            </form>
        </div>
</div>

@endsection
