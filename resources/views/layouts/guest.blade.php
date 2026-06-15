<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0a0a0a">
    <title>{{ $title ?? 'CenBa Admin' }}</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @livewireStyles
    <style>
        [wire\:loading] { display: none; }
    </style>
</head>
<body class="bg-neutral-950 min-h-screen antialiased">

    {{-- Instant page load progress --}}
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 400)"
        x-show="show"
        x-transition:leave="transition-opacity duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] bg-neutral-950 flex items-center justify-center"
        style="display: flex !important"
    >
        <div class="flex flex-col items-center gap-4">
            <h1 class="text-amber-400 text-2xl tracking-widest font-serif">CenBa</h1>
            <div class="w-48 h-0.5 bg-neutral-800 rounded-full overflow-hidden">
                <div class="h-full bg-amber-500 rounded-full animate-[load_0.4s_ease-in-out_forwards]"
                     style="width: 0%; animation: load 0.4s ease-in-out forwards;">
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes load {
            from { width: 0% }
            to   { width: 100% }
        }
    </style>

    {{ $slot }}

    @livewireScripts
</body>
</html>