@extends('project.layout.project')

@section('content')

<div class="fixed bottom-5 right-5">
    <a href="{{route('project_add_tugas')}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Tambah Tugas</a>
</div>
@endsection
