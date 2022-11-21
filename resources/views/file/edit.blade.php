@extends('project.layout.project')

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{route('file_main')}}" class="inline-block px-6 py-2.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">Kembali</a>
        <p id="name" class="h-10 leading-10 text-black text-lg">contoh_file.html</p>
    </div>
    <textarea id="text" rows="24" class="w-full">Ini adalah contoh text...</textarea>
    <div class="flex justify-end mt-6">
        <a href="{{route('file_upload')}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Simpan File</a>
    </div>
    <script>
        $('#text').linedtextarea();
    </script>
</div>
@endsection
