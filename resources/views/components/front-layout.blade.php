{{-- resources/views/components/front-layout.blade.php --}}
@props(['title' => null])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? $title . ' | ' . config('app.name') : config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 text-gray-800">

{{-- Navbar --}}
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold">{{ config('app.name') }}</a>
        <div class="space-x-4">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <a href="{{ route('about') }}" class="hover:underline">About</a>
            <a href="{{ route('cars.index') }}" class="hover:underline">Cars</a>
            <a href="{{ route('contact') }}" class="hover:underline">Contact</a>

            @guest
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Sign Up</a>
            @else
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>

{{-- Flash & Validation Messages --}}
<div class="max-w-7xl mx-auto px-4 mt-4 space-y-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

{{-- Main Content --}}
<main class="py-8">
    <div class="max-w-7xl mx-auto px-4">
        {{ $slot }}
    </div>
</main>

{{-- Footer --}}
<footer class="bg-white border-t mt-12">
    <div class="max-w-7xl mx-auto px-4 py-4 text-center text-sm text-gray-600">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
</footer>

</body>
</html>
