<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — CenBa Awards</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @livewireStyles
</head>
<body class="bg-neutral-950 min-h-screen antialiased">
    @livewire('admin.auth.login')
    @livewireScripts
</body>
</html>