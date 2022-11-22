@foreach ($notification as $value)
<div class="mb-4 inline-flex flex-col relative block p-6 rounded-lg shadow-lg bg-white w-full max-h-44 border">
    <div class="flex items-center mb-4">
        <div class="flex flex-row items-center">
            <p class="text-xl">{{$value->project->managed->name}}</p>
            <p class="text-gray-500 ml-10">{{$value->created_at}}</p>
        </div>
    </div>
    <p>{{$value->content}}</p>
    <button onclick="deleteNotifikasi({{$value->id}})" class="absolute inline-block top-8 right-8 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-30 scale-y-30 p-2.5 text-xs font-bold rounded-full z-5 text-gray-700">X</button>
</div>
@endforeach
