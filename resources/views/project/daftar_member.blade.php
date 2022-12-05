@extends('project.layout.project')

@section('js')
    <script src="{{ asset('js/emails-input.js') }}"></script>
    <link rel="stylesheet" src="{{ asset('css/emails-input.css') }}" />
    <script src="{{asset('js/jquery-daftar-member.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script defer>
    </script>
@endsection

@section('content')

<div class="flex flex-col h-full w-full p-6">
    <span class="text-3xl mb-6">Daftar Member</span>
    <div class="fixed flex top-0 right-0 justify-end pt-4 pr-4 w-full">
        @if (Session::has('pesan'))
            @component('components.alert')
                @slot('type')
                    {{ Session::get('pesan')['type'] }}
                @endslot
                @slot('pesan')
                    {{ Session::get('pesan')['msg'] }}
                @endslot
            @endcomponent
        @endif
    </div>

    <div class="w-full gap-x-5 mb-4 relative">
        <div class="flex items-center">
            <div class="relative w-1/2 text-gray-600 focus-within:text-gray-400">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">

                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                    </svg>
                </span>
                <div id="search" class="rounded border text-sm rounded-md pl-10">

                </div>
                {{-- <input id="search" type="email"  value="{{ old( 'email', '' ) }}" multiple name="{{ 'email' }}"
                placeholder="Email address or name">
                @error('email')
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs ml-1">
                        {{$message}}
                    </span>
                @enderror --}}

            </div>

            <button
            id="btnAdd"
            class="bg-blue-500 d-block hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="button">
                Share
            </button>
        </div>

        <div id="search-result" class="flex flex-col absolute border border-gray bg-white w-1/2 z-10 top-[44px]" >

        </div>
    </div>


    <div class="flex flex-1 flex-col h-full gap-y-5">


        @foreach ($project_member as $item)
            <div class="flex flex-col pl-2 border border-black rounded">
                <span class="text-2xl">
                    {{$item->name . ' ' . ($user->id == $item->id ? '(you)' : '')}}

                </span>
                <span>
                    {{$item->email . ' • ' . ($item->id == $project->project_manager_id ? 'Project Manager' : 'Member')}}

                </span>
            </div>
        @endforeach
    </div>
</div>

@endsection
