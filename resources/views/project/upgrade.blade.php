@extends('project.layout.project')

@section('js')
    <script src="{{asset('js/jquery-upgrade.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{config('midtrans.client_key')}}"></script>
@endsection

@section('content')
<div class="h-full p-10 w-full flex justify-center" style="">
    <div class="detail-kalender p-5 mb-5 container overflow-y-auto" id="layout-detail-kalender">
        <button class="button" onclick="snap_pay()">
            Pay Now
        </button>
    </div>
</div>
@endsection
