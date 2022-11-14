@extends('user.layout.main')

@section('content')
<div class="grid grid-cols-2 gap-4 h-full overflow-y-auto p-10">
    @for ($i = 0; $i < 10; $i++)
    <div class="flex justify-center">
        <div class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44">
          <h5 class="text-gray-900 text-xl leading-tight font-medium mb-3">Contoh Project</h5>
          {{-- <p class="text-gray-700 text-base mb-4">
            Ini adalah contoh deskripsi project...
          </p> --}}
          <div class="w-full bg-gray-200 rounded-full">
            <div class="bg-green-600 text-xs font-medium text-green-100 text-center p-0.5 leading-8 rounded-l-full h-10" style="width: 25%">25%</div>
          </div>
          <a href="{{route('user_project')}}" class="mt-3 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Detail</a>
        </div>
      </div>
    @endfor
</div>
@endsection
