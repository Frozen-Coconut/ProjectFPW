@extends('project.layout.project')

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
    {{-- <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name_project">
            Nama Project
        </label>
        <input name="file" id="file" type="file" class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @error('file')
        <p class="text-red-500">{{$message}}</p>
        @enderror
    </div> --}}

    <div class="mb-6">
        <a href="{{route('file_main')}}" class="inline-block px-6 py-2.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">Kembali</a>
    </div>
</div>
@endsection
