<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard - Secma</title>
        <meta name="description" content="">

        <!-- Favicon -->
        <link href="{{ asset('favicon.ico') }}" rel="shortcut icon">
        <!-- Estilo -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/dash.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">    
        <!-- Script -->
        <script src="{{ asset('js/dash.js') }}" defer></script>
        @livewireStyles
    </head>
    <body class="bg-light">

        @include('dash.includes.header')
        
        {{ $slot }}
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        @livewireScripts
    </body>
</html>