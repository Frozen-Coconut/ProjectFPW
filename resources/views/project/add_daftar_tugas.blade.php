@extends('project.layout.project')

@section('content')
<div class="w-full flex flex-col h-screen justify-evenly px-10">
    <form action="{{route('project_add_tugas_post')}}" method="POST" class="bg-white shadow-md border-2 rounded px-8 pt-6 pb-8">
        <p class="text-3xl mb-5">Buat Tugas</p>
        @csrf
        <input type="hidden" name="id_project" value="{{$project_sekarang->id}}">
        <div class="mb-4 flex" style="width: 100%">
        <div class="mr-4" style="width: 100%">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name_project">
                Nama Tugas
            </label>
            <input class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name_tugas" id="name_tugas" type="text" placeholder="Nama Tugas" value="{{old('name_tugas')}}">
            @error('name_tugas')
            <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        <div style="width: 100%">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="invitation_code_1">
                Tag
            </label>
            <input class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="tag" id="tag" type="text" placeholder="Tag" value="{{old('tag')}}">
            @error('tag')
            <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        </div>
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="invitation_code_1">
            Deadline
        </label>
        <input class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="deadline" id="deadline" type="date" placeholder="Deadline" value="{{old('deadline')}}">
        @error('deadline')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        </div>
        <div class="flex items-center justify-between">
        <button name="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Buat Tugas
        </button>
        </div>
    </form>
    <form action="{{route('project_assign_tugas_post')}}" method="POST" class="bg-white shadow-md border-2 rounded px-8 pt-6 pb-8">
        @csrf
        <p class="text-3xl mb-5">Penugasan Tugas</p>
        <div class="mb-5">
            <p class="text-red-500">{{Session::get('errMsg') ?? ""}}</p>
            <p class="text-green-500">{{Session::get('succMsg') ?? ""}}</p>
        </div>
        <div class="mb-4 flex" style="width: 100%">
        <div class="mr-4" style="width: 100%">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name_project">
                Tugas
            </label>
            <select name="tugas" id="" class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="-1" selected hidden>Tugas yang ingin dipilih</option>
                @foreach ($project_sekarang->to_dos as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            @error('tugas')
            <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        <div style="width: 100%">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="invitation_code_1">
                Pengguna
            </label>
            <select name="user" id="" class="shadow appearance-none border bg-gray-50 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="-1" selected hidden>Orang yang ingin ditugaskan</option>
                @foreach ($project_sekarang->users as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            @error('user')
            <p class="text-red-500">{{$message}}</p>
            @enderror
        </div>
        </div>
        <div class="flex items-center justify-between">
        <button name="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Tugaskan
        </button>
        </div>
    </form>
</div>
@endsection
