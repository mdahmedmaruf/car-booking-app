{{-- resources/views/components/dashboard-layout.blade.php --}}
@props(['title' => null])

<x-app-layout>
    {{-- Pass the header slot up to x-app-layout --}}
    <x-slot name="header">
        {{ $header }}
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 text-white p-6">
            <h1 class="text-2xl font-bold mb-8">{{ config('app.name') }}</h1>

            <nav class="space-y-2 text-sm">
                {{-- Common link --}}
                <a href="{{ route('dashboard') }}"
                   class="block px-4 py-2 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                    Dashboard
                </a>

                @if(Auth::user()->isAdmin())
                    {{-- Admin-only links --}}
                    <a href="{{ route('admin.cars.index') }}"
                       class="block px-4 py-2 rounded {{ request()->routeIs('admin.cars.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Manage Cars
                    </a>
                    <a href="{{ route('admin.rentals.index') }}"
                       class="block px-4 py-2 rounded {{ request()->routeIs('admin.rentals.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Manage Rentals
                    </a>
                    <a href="{{ route('admin.customers.index') }}"
                       class="block px-4 py-2 rounded {{ request()->routeIs('admin.customers.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Manage Customers
                    </a>
                @else
                    {{-- Customer-only links --}}
                    <a href="{{ route('cars.index') }}"
                       class="block px-4 py-2 rounded {{ request()->routeIs('cars.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        Browse Cars
                    </a>
                    <a href="{{ route('rentals.index') }}"
                       class="block px-4 py-2 rounded {{ request()->routeIs('rentals.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                        My Bookings
                    </a>
                @endif

                {{-- Common profile link --}}
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 rounded {{ request()->routeIs('profile.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                    My Profile
                </a>
            </nav>
        </aside>

        {{-- Main content --}}
        <main class="flex-1 p-6 overflow-auto">
            {{ $slot }}
        </main>
    </div>
</x-app-layout>
