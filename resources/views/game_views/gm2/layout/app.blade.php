<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="{{ asset('css/game2.css') }}">



</head>

<body>
    @include('game_views.gm2.partials.navbar')

    <div class="main_body">
        @yield('content')
    </div>

    <script src="{{ asset('js/game2.js') }}"></script>
</body>

</html>
