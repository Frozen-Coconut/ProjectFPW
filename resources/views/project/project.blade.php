@extends('project.layout.project')

@section('js')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

@section('content')
<div class="w-full h-screen flex flex-col p-8 overflow-y-auto">
    <p class="text-4xl mb-6 ml-4">{{$project->name_project}}</p>
    <div class="w-full bg-gray-200 rounded-full mb-8">
        <div class="bg-green-600 text-xs font-medium text-green-100 text-center p-0.5 leading-8 rounded-l-full h-10" style="width: {{$project->percent_completed()}}%">{{$project->percent_completed()}}%</div>
    </div>
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

<div class="fixed top-8 right-8">
    <a href="{{route('project_notification')}}">
        <div class="inline-flex relative w-fit" style="height: 40px;">
            @if($user->notifications()->where('status', '=', 1)->count() > 0)
                <div class="absolute inline-block top-0 right-0 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-30 scale-y-30 p-1.5 text-xs bg-pink-700 rounded-full z-5"></div>
            @endif
            <div class="px-1 py-1 bg-blue-500 flex items-center justify-center text-center rounded-lg shadow-lg">
              <div>
                <svg style="width: 30px;height:30px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="mx-auto text-white w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                  <path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                </svg>
              </div>
            </div>
        </div>
    </a>
</div>
@endsection
