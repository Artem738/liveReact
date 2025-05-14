<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/livewire.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    @include('layouts.partials.header')

    <main>
        @yield('content')
    </main>

      @livewireScriptConfig
</body>

</html>
