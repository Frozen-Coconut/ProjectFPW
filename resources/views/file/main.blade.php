@extends('project.layout.project')

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
    <p class="text-3xl mb-8">File Anda</p>

    <table class="table-auto w-full border-2 rounded text-center">
        <thead>
            <tr class="border-b-2">
                <th>Nama File</th>
                <th>Pemilik</th>
                <th>Perubahan Terakhir</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b hover:bg-gray-100">
                <td>Ini_contoh_folder</td>
                <td>User 1</td>
                <td>2022-10-11 21:50</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td>Ini_contoh_file_1.txt</td>
                <td>User 1</td>
                <td>2022-10-11 21:37</td>
            </tr>
            <tr class="border-b hover:bg-gray-100">
                <td>Ini_contoh_file_2.txt</td>
                <td>User 2</td>
                <td>2022-10-11 21:40</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="fixed bottom-5 right-5">
    <a href="{{route('file_upload')}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Tambah File</a>
</div>
@endsection
