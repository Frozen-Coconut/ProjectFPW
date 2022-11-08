@extends('layout.main')

@section('body')
<div class="container w-screen min-h-screen px-4 py-20 relative">
    <table class="table-auto w-full border-2 rounded text-center">
        <thead>
            <tr class="border-b-2">
                <th>Name</th>
                <th>Owner</th>
                <th>Last Modified</th>
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

    <button type="button" id="back" class="w-20 h-10 border rounded bg-gray-500 text-white absolute top-4 left-4">Back</button>
    <button type="button" id="upload" class="w-32 h-10 border rounded bg-blue-500 text-white absolute top-4 right-4">Upload File</button>
</div>
@endsection
