@foreach ($daftar_tugas as $value)
<div class="bg-white shadow-md border-2 rounded px-8 pt-6 pb-8">
    <p class="text-3xl mb-5">{{$value->name}}</p>
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name_project">
        Deadline : {{date_format(date_create($value->deadline),'d F Y')}}
    </label>
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name_project">
        Project : {{$value->project->name_project}}
    </label>
    <label class="block text-gray-700 text-sm font-bold mb-2" for="name_project">
        Status :
        @if ($value->pivot->status == 1)
            Belum Selesai
        @else
            Selesai
        @endif
    </label>
</div>
@endforeach
