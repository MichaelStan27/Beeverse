<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/241615b24e.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <title>@yield('title')</title>
</head>

<body>
    @include('partials.notification-card')
    @include('partials.navbar')
    @yield('content')
</body>

<style>
    ::-webkit-scrollbar {
        height: 8px;
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: white;
    }

    ::-webkit-scrollbar-thumb {
        background: gray;
    }
</style>

</html>
