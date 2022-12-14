@extends('admin.layouts.layout_main')

@section('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" integrity="sha512-giQeaPns4lQTBMRpOOHsYnGw1tGVzbAIHUyHRgn7+6FmiEgGGjaG0T2LZJmAPMzRCl+Cug0ItQ2xDZpTmEc+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" integrity="sha512-6mc0R607di/biCutMUtU9K7NtNewiGQzrvWX4bWTeqmljZdJrwYvKJtnhgR+Ryvj+NRJ8+NnnCM/biGqMe/iRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

@section('content')

<div class="w-full h-screen flex flex-row p-8 overflow-y-auto">
    <div class="h-full flex justify-end px-3 py-3" style="width: 50%">
        <div style=";height:100%" class=" border border-gray-800 rounded-xl p-5 overflow-y-auto container">
            <span class="font-medium ml-4 mb-3">Daftar User</span>
            <div class="ml-4 mt-5">
                <div class="overflow-y-auto container" style="height: 100%">
                    @foreach ($project->users as $item)
                    <div class="w-max p-2.5 mb-3 flex justify-center items-center">
                        <span class="fa-solid fa-user"></span>
                      <span class="font-medium ml-4">{{$item->name. ' - '. $item->email}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="h-full flex justify-end px-3 py-3" style="width: 50%">
        <div style="height:100%" class=" border border-gray-800 rounded-xl p-5 overflow-y-auto container">
            <span class="font-medium ml-4 mb-3">Daftar Tugas</span>
            <div class="ml-4 mt-5">
                <div class="overflow-y-auto container" style="height: 100%">
                    @foreach ($project->to_dos as $item)
                    <div class="w-max p-2.5 mb-3 flex justify-center items-center">
                        <span class="fas fa-tasks"></span>
                      <span class="font-medium ml-4">{{$item->name. ' - '. $item->deadline}}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
