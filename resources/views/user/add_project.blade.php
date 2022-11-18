@extends('user.layout.main')

@section('content')
<div class="w-full flex flex-col h-screen justify-evenly px-10">
    <form action="{{route('user_add_project_post')}}" method="POST" class="bg-white shadow-md border-2 rounded px-8 pt-6 pb-8">
        <p class="text-3xl mb-5">Buat Project</p>
        @csrf
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name_project">
            Nama Project
        </label>
        <input class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name_project" id="name_project" type="text" placeholder="Nama Project" value="{{old('name_project')}}">
        @error('name_project')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        </div>
        <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="invitation_code_1">
            Kode Invitasi
        </label>
        <input class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="invitation_code_1" id="invitation_code_1" type="text" placeholder="Kode Invitasi" value="{{old('invitation_code_1')}}">
        @error('invitation_code_1')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        </div>
        <div class="flex items-center justify-between">
        <button name="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Buat Project
        </button>
        </div>
    </form>
    <form action="{{route('user_add_project_post')}}" method="POST" class="bg-white shadow-md border-2 rounded px-8 pt-6 pb-8">
        <p class="text-3xl mb-5">Gabung Project</p>
        @csrf
        <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="invitation_code_2">
            Kode Invitasi
        </label>
        <input class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="invitation_code_2" id="invitation_code_2" type="text" placeholder="Kode Invitasi" value="{{old('invitation_code_2')}}">
        @error('invitation_code_2')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        </div>
        <div class="flex items-center justify-between">
        <button name="join" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Gabung Project
        </button>
        </div>
    </form>
    </div>
@endsection
