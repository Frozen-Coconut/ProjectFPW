@extends('project.layout.project')

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
    <p class="text-3xl mb-8">File Anda</p>

    <table class="table-auto w-full border-2 rounded text-center">
        <thead>
            <tr class="border-b-2">
                <th>File</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($path != '/public/' . session('projectSekarang') . '/')
            <tr class="border-b hover:bg-gray-100">
                <td><a href="{{route('file_main')}}?path=/{{$path_sebelumnya}}">..</a></td>
                <td>Directory</td>
                <td></td>
            </tr>
            @endif
            @foreach ($folders as $folder)
            <tr class="border-b hover:bg-gray-100">
                <td><a href="{{route('file_main')}}?path={{str_replace("public/$project/", '', $folder)}}">{{basename($folder)}}</a></td>
                <td>Directory</td>
                <td><form action="{{route('file_edit_post')}}" method="POST">
                    @csrf
                    <button type="submit" name="deleteFolder" class="m-2 inline-block px-5 py-2 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Delete</button>
                    <input type="hidden" name="path" value="{{str_replace("public/$project/", '', $folder)}}">
                </form></td>
            </tr>
            @endforeach
            @foreach ($files as $file)
            <tr class="border-b hover:bg-gray-100">
                <td><a href="{{route('file_edit')}}?path={{str_replace("public/$project/", '', $file)}}">{{basename($file)}}</a></td>
                <td>File</td>
                <td><form action="{{route('file_edit_post')}}" method="POST">
                    @csrf
                    <button type="submit" name="delete" class="m-2 inline-block px-5 py-2 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Delete</button>
                    <input type="hidden" name="path" value="{{str_replace("public/$project/", '', $file)}}">
                </form></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="fixed bottom-5 right-5">
    <a href="{{route('file_upload')}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Tambah File</a>
</div>
@endsection
