@extends('layout.main')

@section('body')
<h1 class="text-xl">Register (MASIH JELEK, JANGAN LUPA DIPERBAIKI)</h1>
<a href="https://v1.tailwindcss.com/components/forms">https://v1.tailwindcss.com/components/forms</a>
<form action="{{route('doRegister')}}" method="POST">
    @csrf
    <label for="email">Email</label><br>
    <input type="text" name="email" id="email" value="{{old('email')}}"><br>
    @error('email')
        <p class="text-red-500">{{$message}}</p>
    @enderror
    <label for="name">Nama lengkap</label><br>
    <input type="text" name="name" id="name" value="{{old('name')}}"><br>
    @error('name')
        <p class="text-red-500">{{$message}}</p>
    @enderror
    <label for="password">Password</label><br>
    <input type="password" name="password" id="password"><br>
    @error('password')
        <p class="text-red-500">{{$message}}</p>
    @enderror
    <label for="password_confirmation">Konfirmasi password</label><br>
    <input type="password" name="password_confirmation" id="password_confirmation"><br>
    @error('password_confirmation')
        <p class="text-red-500">{{$message}}</p>
    @enderror
    <label for="occupational_status">Pekerjaan</label><br>
    <select name="occupational_status" id="occupational_status">
        <option value="0">Pelajar</option>
        <option value="1">Mahasiswa</option>
        <option value="2">Pekerja</option>
        <option value="3">Yang lainnya</option>
    </select><br>
    @error('occupational_status')
        <p class="text-red-500">{{$message}}</p>
    @enderror
    <button type="submit" name="register">Register</button>
</form>
<a href="{{route('login')}}">Menuju Login</a>
@endsection