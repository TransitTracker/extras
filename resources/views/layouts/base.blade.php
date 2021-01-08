<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')
            <title>@yield('title') - Extras Catcher</title>
        @else
            <title>Extras Catcher</title>
        @endif
		
        <!-- Favicon -->
		<link rel="icon" type="image/svg+xml" href="{{ url(asset('favicon.svg')) }}">
		<link rel="alternate icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
        @livewireStyles

        <!-- Scripts -->
        @livewireScripts
        <script src="{{ url(mix('js/app.js')) }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/spruce@2.x.x/dist/spruce.umd.js"></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        @yield('body')

        <script src="{{ url(mix('js/app.js')) }}"></script>
    </body>

    <style>
        @media (min-width: 768px) {
            .md\:h-\(screen-16\) {
                height: calc(100vh - 4rem);
            }
            .md\:max-h-\(screen-32\) {
                max-height: calc(100vh - 8rem);
            }
        }
    </style>
</html>
