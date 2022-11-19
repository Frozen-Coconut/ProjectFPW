<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Manager</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('head')
</head>
<body>
    @if (session('message_error'))
        <div class="w-full bg-red-200">{{session('message_error')}}</div>
    @elseif (session('message_success'))
        <div class="w-full bg-green-200">{{session('message_success')}}</div>
    @endif
    @yield('body')
</body>
</html>
