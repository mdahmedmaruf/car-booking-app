<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100">
<x-nav />        {{-- your nav component --}}
<main class="container mx-auto py-8">
    {{ $slot }}
</main>
<x-footer />     {{-- optional footer --}}
</body>
</html>
