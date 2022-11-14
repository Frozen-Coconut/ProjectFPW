@extends('layout.main')

@section('body')
<h1 class="text-xl">Login (MASIH JELEK, JANGAN LUPA DIPERBAIKI)</h1>
<form action="{{route('login_post')}}" method="POST">
    @csrf
    Email: <input type="text" name="email"><br>
    Password: <input type="password" name="password"><br>
    <button name="submit">Submit</button>
</form>
@endsection
