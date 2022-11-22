@extends('project.layout.project')

@section('content')
<form action="{{route('file_edit_post')}}" class="w-full h-screen flex flex-col p-8 overflow-y-auto" method="POST">
    @csrf
    <div class="mb-6 flex justify-between items-center">
        <a href="{{url()->previous()}}" class="inline-block px-6 py-2.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">Kembali</a>
        {{-- <p id="name" class="h-10 leading-10 text-black text-lg">{{basename($file)}}</p> --}}
        @error('name')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        <input name="name" type="text" class="shadow appearance-none border bg-gray-50 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{basename($file)}}">

        <input type="hidden" name="path" id="path" value="{{$file}}">
    </div>
    <textarea id="text" name="text" rows="24" class="w-full">{{$text}}</textarea>
    <div class="flex justify-end mt-6">
        <button name="download" class="mr-4 inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Download File</button>
        <button name="delete" class="mr-4 inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Hapus File</button>
        <button name="save" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Simpan File</button>
    </div>
    <script>
        $('#text').linedtextarea();
    </script>
</form>
@endsection
