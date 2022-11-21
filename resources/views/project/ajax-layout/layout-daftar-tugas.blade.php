<div style="height: 70vh" class="w-full overflow-y-auto container">
@foreach ($daftar_tugas as $value)
    <a href="{{route('project_detail_tugas',[
        "id"=>$value->id
    ])}}">
        <div class="w-full mb-4 flex flex-row justify-start px-10 items-center border border-gray-500 rounded-lg p-3" style="">
            <div style="width: 2%;" class="mr-3 flex justify-start items-center">
                <svg class="w-full h-full @if ($value->pivot->status != 1)
                    text-blue-500
                @else
                    text-gray-500
                @endif
                dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div style="width: 40%;" class=" h-full flex justify-start items-center">
                <label class="block text-gray-700 text-sm font-bold">
                    {{$value->name}}
                </label>
            </div>
            <div style="width: 30%;" class="flex justify-start items-center">
                <label class=" block text-gray-500 text-sm font-bold">
                    {{date_format(date_create($value->deadline),'d F Y')}}
                </label>
            </div>
            <div style="width: 20%;" class="flex justify-start items-center">
                <label class="block text-gray-500 text-sm font-bold border border-gray-500 rounded-lg px-5 py-1" for="name_project">
                    {{$value->tag}}
                </label>
            </div>
            <div class="flex justify-start items-center">
                <button onclick="sortCustom({{$value->id}})" id="{{$value->id}}" class="check-list-sort hidden text-gray-500 border border-gray-700 rounded-sm w-5 h-5 flex justify-center items-center"></button>
            </div>
        </div>
    </a>
@endforeach
</div>
