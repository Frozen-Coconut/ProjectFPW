@extends('project.layout.project')

@section('js')
    <script src="{{asset('js/jquery-daftar-tugas.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

@section('content')
<div class="p-6 h-full w-full">
    <p class="text-3xl mb-10">Daftar Tugas</p>
    <div class="flex justify-center" style="width: 100%">
        <div class="mb-3 w-full px-10">
          <div class="input-group relative flex items-stretch w-full mb-4 rounded">
            <input id="search-tag" type="search" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search by Tag" aria-label="Search" aria-describedby="button-addon2">
            <button onclick="search()" class="input-group-text flex items-center px-3 py-1.5 text-base font-normal text-gray-700 text-center whitespace-nowrap rounded" id="basic-addon2">
              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
              </svg>
            </button>
          </div>
        </div>
    </div>
    @if($user->id != $project->project_manager_id)
    <div class="flex justify-end mb-8">
        <button onclick="ubahModeSort()" id="save_sort" class="inline-block px-6 mr-3 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Urutkan</button>
        <select onchange="sortUbah()" name="sort" id="sort" class="bg-gray-50 border border-gray-300 w-60 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="-1" selected hidden>Urutkan berdasarkan</option>
            <option value="0">Berdasarkan Nama (Desc)</option>
            <option value="1">Berdasarkan Nama (Asc)</option>
            <option value="2">Berdasarkan Deadline (Desc)</option>
            <option value="3">Berdasarkan Deadline (Asc)</option>
            <option value="4">Custom Order</option>
        </select>
    </div>
    @endif
    <div style="" class="flex flex-col justify-end " id="layout-daftar-tugas">

    </div>
</div>

@if ($user->id == $project->project_manager_id)
<div class="fixed top-8 right-5">
    <a href="{{route('project_add_tugas')}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Tambah Tugas</a>
</div>
<input type="hidden" name="" id="pm" value="0">
@else
<input type="hidden" name="" id="pm" value="1">
@endif

@endsection
