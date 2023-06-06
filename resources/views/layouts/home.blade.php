<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - Roomly</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- TailwindCSS -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        @section('header')
            HEADER 2
        @show
 
        <div class="container">
            @yield('content')
        </div>

        @section('footer')
            FOOTER 2
        @show
    </body>
</html>