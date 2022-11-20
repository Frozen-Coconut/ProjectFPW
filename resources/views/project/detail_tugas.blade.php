@extends('project.layout.project')

@section('js')

@endsection

@section('content')
<div class="p-10 h-full">
    <p class="text-3xl mb-10">{{$to_do->name}}</p>
    <div class="w-full flex flex-row" style="height:50%">
        <div class="h-full" style="width:50%;">
            <p class="text-2xl mb-10 text-gray-600">{{'Deadline pada tanggal '.date_format(date_create($to_do->deadline),'d F Y')}}</p>
        </div>
        <div class="h-full flex justify-end px-10 py-3" style="width: 50%">
            <div style="width:60%;height:100%" class=" border border-gray-800 rounded-xl p-5 overflow-y-auto">
                <span class="font-medium ml-4 mb-3">Diserahkan Kepada</span>
                @foreach ($to_do->users as $item)
                <div class="w-max p-2.5 mb-3 flex justify-center items-center">
                    <img src="https://via.placeholder.com/100" class="w-8 rounded-full" alt="placeholder">
                    <span class="font-medium ml-4">{{$item->name}}</span>
                  </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="fixed top-10 right-5">
   @if($status == 1)
    <a href="{{route('project_update_status_to_do',[
        "id" => $to_do->id, "status" => 2
    ])}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Tandai Sudah Selesai</a>
   @else
    <a href="{{route('project_update_status_to_do',[
        "id" => $to_do->id, "status" => 1
    ])}}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Batalkan Selesai</a>
   @endif
</div>
@endsection
