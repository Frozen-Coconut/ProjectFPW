@extends('project.layout.project')

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
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
    <form action="{{route('project_add_post_comment')}}" method="POST" class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border mb-4 flex flex-col">
        @csrf
        <input type="text" name="comment" id="comment" value="{{old('comment')}}" class="border-2 rounded-lg p-2" placeholder="Tuliskan komentar anda di sini...">
        @error('comment')
        <p class="text-red-500">{{$message}}</p>
        @enderror
        <div class="flex justify-end">
            <button type="submit" name="add" id="add" class="bg-blue-600 text-white mt-4 rounded-lg px-4 py-1">Tambah Komentar</button>
        </div>
    </form>
    @foreach ($post->post_comments()->orderBy('id', 'desc')->get() as $comment)
    <div class="block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border mb-4 flex flex-col">
        <div class="flex items-center mb-4">
            <img src="https://via.placeholder.com/100" class="h-12 w-12 rounded-full mr-4" alt="placeholder">
            <div class="flex flex-col">
                <p class="text-xl">{{$comment->user->name}}</p>
                <p class="text-gray-500">{{$comment->created_at}}</p>
            </div>
        </div>
        <p>{{$comment->contents}}</p>
    </div>
    @endforeach
</div>
@endsection
