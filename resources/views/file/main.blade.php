@extends('project.layout.project')

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
    <p class="text-3xl mb-8">File Anda</p>

    <table class="table-auto w-full border-2 rounded text-center">
        <thead>
            <tr class="border-b-2">
                <th>File</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($folders as $folder)
            <tr class="border-b hover:bg-gray-100">
                <td>{{basename($folder)}}</td>
                <td>Directory</td>
            </tr>
            @endforeach
            @foreach ($files as $file)
            <tr class="border-b hover:bg-gray-100">
                <td>{{basename($file)}}</td>
                <td>File</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="fixed bottom-5 right-5">
    <a href="{{route('file_upload')}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Tambah File</a>
</div>
@endsection
