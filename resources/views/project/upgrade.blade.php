@extends('project.layout.project')

@section('js')
    <script src="{{asset('js/jquery-upgrade.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{config('midtrans.client_key')}}"></script>
@endsection

@section('content')
<div class="h-full p-10 w-full flex flex-col justify-center bg-black text-white font-quicksand">
    <div class="container mx-10 flex items-center">
        <div class="w-2/5 grid place-items-center">
            <h2 class="text-4xl text-center mb-3">Upgrade your plan to access more features</h2>
            <h5 class="text-gray-400 italic">pay now access forever</h5>
        </div>
        <div class="w-3/5 flex items-center justify-center">

            @if ($status == 0)
                <div class="px-6 py-8 w-80 bg-white/5 rounded-md">
                    <div class="flex items-baseline justify-between mb-3">
                        <h3 class="uppercase mb-3 font-semibold">Free</h3>
                        <div class="border rounded-full px-3">
                            <h5 class="text-sm">Current Plan</h5>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-1 w-full mb-6">
                        <h2 class="text-3xl">
                            Rp. 0
                        </h2>
                        <h4 class="text-sm font-semibold">One time payment</h4>
                    </div>
                    <!-- <button type="button" onclick="snap_pay()" class="border border-white w-full rounded-md text-white py-2 text-sm mb-6">
                        Downgrade now
                    </button> -->
                    <div class="flex flex-col divide-y divide-gray-700 text-red-500">
                        <div class="flex items-center gap-x-4 py-2">
                            <svg class="w-3 h-3 stroke-red-500" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            <h5>File Uploads</h5>
                        </div>
                        <div class="flex items-center gap-x-4 py-2">
                            <svg class="w-3 h-3 stroke-red-500" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            <h5>Edit File</h5>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-8 w-80 rounded-md text-black bg-white outline outline-white">
                    <div class="flex items-baseline justify-between mb-3">
                        <h3 class="uppercase mb-3 font-semibold">Premium</h3>
                        <!-- <div class="border rounded-full px-3">
                            <h5 class="text-sm">Current Plan</h5>
                        </div> -->
                    </div>
                    <div class="flex flex-col gap-y-1 w-full mb-6">
                        <h2 class="text-3xl">
                            Rp. 100.000,00
                        </h2>
                        <h4 class="text-sm font-semibold">One time payment</h4>
                    </div>
                    <button type="button" onclick="snap_pay()" class="w-full bg-black rounded-md text-white py-2 text-sm mb-6">
                        Upgrade now
                    </button>
                    <div class="flex flex-col divide-y text-green-500">
                        <div class="flex items-center gap-x-4 py-2">
                            <svg class="w-3 h-3 stroke-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <h5>File Uploads</h5>
                        </div>
                        <div class="flex items-center gap-x-4 py-2">
                            <svg class="w-3 h-3 stroke-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <h5>Edit File</h5>
                        </div>
                    </div>
                </div>
            </div>
            @else

                <div class="px-6 py-8 w-80 bg-white/5 rounded-md">
                    <div class="flex items-baseline justify-between mb-3">
                        <h3 class="uppercase mb-3 font-semibold">Free</h3>
                    </div>
                    <div class="flex flex-col gap-y-1 w-full mb-6">
                        <h2 class="text-3xl">
                            Rp. 0
                        </h2>
                        <h4 class="text-sm font-semibold">One time payment</h4>
                    </div>
                    <!-- <button type="button" onclick="snap_pay()" class="border border-white w-full rounded-md text-white py-2 text-sm mb-6">
                        Downgrade now
                    </button> -->
                    <div class="flex flex-col divide-y divide-gray-700 text-red-500">
                        <div class="flex items-center gap-x-4 py-2">
                            <svg class="w-3 h-3 stroke-red-500" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            <h5>File Uploads</h5>
                        </div>
                        <div class="flex items-center gap-x-4 py-2">
                            <svg class="w-3 h-3 stroke-red-500" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            <h5>Edit File</h5>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-8 w-80 rounded-md text-black bg-white outline outline-white">
                    <div class="flex items-baseline justify-between mb-3">
                        <h3 class="uppercase mb-3 font-semibold">Premium</h3>

                        <div class="border rounded-full border-black px-3">
                            <h5 class="text-sm font-semibold">Current Plan</h5>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-1 w-full mb-6">
                        <h2 class="text-3xl">
                            Rp. 100.000,00
                        </h2>
                        <h4 class="text-sm font-semibold">One time payment</h4>
                    </div>
                    <div class="flex flex-col divide-y text-green-500">
                        <div class="flex items-center gap-x-4 py-2">
                            <svg class="w-3 h-3 stroke-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <h5>File Uploads</h5>
                        </div>
                        <div class="flex items-center gap-x-4 py-2">
                            <svg class="w-3 h-3 stroke-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <h5>Edit File</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
</div>
@endsection
