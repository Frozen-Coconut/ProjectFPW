@extends('project.layout.project')

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
    <p class="text-4xl mb-6 ml-4">{{$project->name_project}}</p>
    <div class="w-full bg-gray-200 rounded-full mb-8">
        <div class="bg-green-600 text-xs font-medium text-green-100 text-center p-0.5 leading-8 rounded-l-full h-10" style="width: 20%">20%</div>
    </div>
    @foreach ($project->posts as $post)
    <div class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border mb-4 flex flex-col">
        <div class="flex items-center mb-4">
            <img src="https://via.placeholder.com/100" class="h-12 w-12 rounded-full mr-4" alt="placeholder">
            <div class="flex flex-col">
                <p class="text-xl">{{$post->user->name}}</p>
                <p class="text-gray-500">{{$post->created_at}}</p>
            </div>
        </div>
        <p>{{$post->contents}}</p>
    </div>
    @endforeach
    <form action="{{route('project_add_post')}}" method="POST" class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border mb-4 flex flex-col">
        @csrf
        <input type="text" name="post" id="post" value="{{old('post')}}" class="border-2 rounded-lg p-2" placeholder="Tuliskan post anda di sini...">
        @error('post')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        <div class="flex justify-end">
            <button type="submit" name="add" id="add" class="bg-blue-600 text-white mt-4 rounded-lg px-4 py-1">Tambah Post</button>
        </div>
    </form>
</div>
@endsection
