@extends('admin.layouts.layout_main')

@section('content')
@if ($projects->count() <= 6)
<div class="grid grid-cols-2 grid-rows-3 gap-8 h-full overflow-y-auto p-10">
@else
<div class="grid grid-cols-2 gap-8 h-full overflow-y-auto p-10">
@endif
    @foreach ($projects as $project)
    <div class="flex justify-center">
        <div class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border">
          <h5 class="text-gray-900 text-xl leading-tight font-medium mb-3">{{$project->name_project}}</h5>
          {{-- <p class="text-gray-700 text-base mb-4">
            Ini adalah contoh deskripsi project...
          </p> --}}
          <div class="w-full bg-gray-200 rounded-full inline-flex relative">
            <div class="bg-green-600 text-xs font-medium text-gray-500 text-center leading-8 rounded-l-full h-10" style="width: {{$project->percent_completed()}}%"></div>
            <p class="absolute inline-block text-xs font-medium text-gray-900 z-5 text-center" style="top:50%;right:50%;transform:translate(50%,-50%)">{{$project->percent_completed()}}%</p>
          </div>
          <a href="{{route('admin_project', [
            'id' => $project->id
          ])}}" class="mt-3 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Detail</a>
        </div>
      </div>
    @endforeach
</div>

@endsection

