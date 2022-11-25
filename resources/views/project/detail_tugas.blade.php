@extends('project.layout.project')

@section('js')
<link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

@section('content')
<div class="p-10 h-full">
    <div class="w-full flex flex-row">
        <div class="flex items-center" style="width: 50%;">
            <p class="text-3xl mb-10">{{$to_do->name}}</p>
        </div>
        @if($user->id != $project->project_manager_id)
        <div class="flex justify-end items-center" style="width: 50%;">
            @if($status == 1)
                <a href="{{route('project_update_status_to_do',[
                    "id" => $to_do->id, "status" => 2
                ])}}" style="height:35px" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Tandai Sudah Selesai</a>
            @else
                <a href="{{route('project_update_status_to_do',[
                    "id" => $to_do->id, "status" => 1
                ])}}" style="height:35px" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Batalkan Selesai</a>
            @endif
        </div>
        @else
        <div class="flex justify-end items-center" style="width: 50%;">
            <a href="{{route('project_edit_tugas', [
                "id" => $to_do->id
            ])}}" style="height:35px" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Edit Tugas</a>
        </div>
        @endif
    </div>
    <div class="w-full flex flex-row" style="height:50%">
        <div class="h-full" style="width:75%;">
            <p class="text-2xl mb-10 text-gray-600">{{'Deadline pada tanggal '.date_format(date_create($to_do->deadline),'d F Y')}}</p>
            <form action="{{route('project_add_comment')}}" method="POST" class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border mb-8 flex flex-col">
                @csrf
                <input type="hidden" name="id_to_do" value="{{$to_do->id}}">
                <input type="text" name="comment" id="post" value="{{old('comment')}}" class="border-2 rounded-lg p-2" placeholder="Tuliskan comment anda di sini...">
                @error('comment')
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <div class="flex justify-end">
                    <button type="submit" name="add" id="add" class="bg-blue-600 text-white mt-4 rounded-lg px-4 py-1">Tambah Post</button>
                </div>
            </form>
            <div class="container h-full w-full overflow-y-auto">
                @foreach ($to_do->to_do_comments()->orderBy('id', 'desc')->get() as $post)
                <div class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border mb-5 flex flex-col">
                    <div class="flex items-center mb-3">
                        <img src="https://via.placeholder.com/100" class="h-12 w-12 rounded-full mr-4" alt="placeholder">
                        <div class="flex flex-col">
                            <p class="text-xl">{{$post->user->name}}</p>
                            <p class="text-gray-500">{{$post->created_at}}</p>
                        </div>
                    </div>
                    <p>{{$post->contents}}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div class="h-full flex justify-end px-10 py-3" style="width: 50%">
            <div style="width:60%;height:100%" class=" border border-gray-800 rounded-xl p-5 overflow-y-auto container">
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
@endsection
