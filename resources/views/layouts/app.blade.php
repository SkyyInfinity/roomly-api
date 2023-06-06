<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Roomly - @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- TailwindCSS -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased h-screen grid grid-admin-layout">
        @section('header')
            @include('admin.partials.header')
        @show

        @section('sidebar')
            @include('admin.partials.sidebar')
        @show
 
        <main id="l-main" class="p-12 h-full">
            @yield('content')
        </main>

        @section('footer')
            @include('admin.partials.footer')
        @show
    </body>
</html>
