@if (session('message_error'))
    <div class="w-full bg-red-200 rounded">{{session('message_error')}}</div>
@elseif (session('message_success'))
    <div class="w-full bg-green-200 rounded">{{session('message_success')}}</div>
@endif
