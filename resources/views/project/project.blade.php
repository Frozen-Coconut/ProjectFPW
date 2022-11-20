@extends('project.layout.project')

@section('content')
<div class="w-full h-screen flex flex-col p-8">
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
</div>
@endsection
