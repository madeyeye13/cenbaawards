<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'CenBa Africa Business Excellence Awards — Celebrating Outstanding Achievement Across Africa' }}">
    <title>{{ $title ?? 'CenBa Africa Business Excellence Awards' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased" style="background: #0D0D0D; color: #FAFAF9; font-family: 'Spline Sans', sans-serif;">

    @include('partials.header')

    <main id="main-content">
        {{ $slot }}
    </main>

    @include('partials.footer')

    @livewireScripts
</body>
</html>