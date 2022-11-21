@extends('user.layout.main')

@section('js')
<link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{asset('js/jquery-kalender.js')}}"></script>
@endsection

@section('content')
    <input type="hidden" name="" id="year-now">
    <input type="hidden" name="" id="month-now">
    <div class="w-full h-full" style="display: flex;flex-direction:row">
        <div class="h-full" style="width: 50%;">
            <div class="mt-8" style="width: 100%;display:flex;justify-content:center;align-items:center;" >
                <button class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20" onclick="kurang()">
                  <span class="sr-only">Previous</span>
                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                  </svg>
                </button>
                <p style="width: 50%;text-align:center;font-weight: bold;" id="label-sekarang">Coba lagi</p>
                <button class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20" onclick="tambah()">
                  <span class="sr-only">Next</span>
                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                  </svg>
                </button>
            </div>
            <div id="layout-kalender" style="width: 100%;">

            </div>
        </div>
        <div class="h-full p-10 pl-20" style="width: 50%">
            <div class="detail-kalender p-5 mb-5 container overflow-y-auto" id="layout-detail-kalender">

            </div>
        </div>
    </div>
@endsection
