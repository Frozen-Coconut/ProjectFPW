@extends('layout.main')

@section('body')
<h1 class="text-xl">Login (MASIH JELEK, JANGAN LUPA DIPERBAIKI)</h1>
<a href="https://v1.tailwindcss.com/components/forms">https://v1.tailwindcss.com/components/forms</a>
<form action="{{route('login_post')}}" method="POST">
    @csrf
    Email: <input type="text" name="email"><br>
    Password: <input type="password" name="password"><br>
    <button name="submit">Submit</button>
</form>
@endsection
