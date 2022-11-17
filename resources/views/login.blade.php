@extends('layout.main')

@section('body')
<h1 class="text-xl">Login (MASIH JELEK, JANGAN LUPA DIPERBAIKI)</h1>
<a href="https://v1.tailwindcss.com/components/forms">https://v1.tailwindcss.com/components/forms</a>
<form action="{{route('doLogin')}}" method="POST">
    @csrf
    <label for="email">Email</label><br>
    <input type="text" name="email" id="email" value="{{old('email')}}"><br>
    @error('email')
        <p class="text-red-500">{{$message}}</p>
    @enderror
    <label for="password">Password</label><br>
    <input type="password" name="password" id="password"><br>
    @error('password')
        <p class="text-red-500">{{$message}}</p>
    @enderror
    <button type="submit" name="login">Login</button>
</form>
<a href="{{route('register')}}">Menuju Register</a>
@endsection
