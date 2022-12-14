@extends('project.layout.project')

@section('js')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
    <p class="text-4xl mb-6 ml-4">{{$project->name_project}}</p>
    <div class="w-full mb-4 bg-gray-200 rounded-full inline-flex relative">
        <div class="bg-green-600 text-xs font-medium text-gray-500 text-center leading-8 rounded-l-full h-10" style="width: {{$project->percent_completed()}}%"></div>
        <p class="absolute inline-block text-xs font-medium text-gray-900 z-5 text-center" style="top:50%;right:50%;transform:translate(50%,-50%)">{{$project->percent_completed()}}%</p>
      </div>
    <div class="flex flex-col container h-full overflow-y-auto">
        @foreach ($project->posts()->orderBy('id', 'desc')->get() as $post)
        <a href="{{route('project_detail_post')}}?id={{$post->id}}" class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border mb-4 flex flex-col">
            <div class="flex items-center mb-4">
                <img src="https://via.placeholder.com/100" class="h-12 w-12 rounded-full mr-4" alt="placeholder">
                <div class="flex flex-col">
                    <p class="text-xl">{{$post->user->name}}</p>
                    <p class="text-gray-500">{{$post->created_at}}</p>
                </div>
            </div>
            <p>{{$post->contents}}</p>
        </a>
        @endforeach
    </div>
</div>

@endsection
