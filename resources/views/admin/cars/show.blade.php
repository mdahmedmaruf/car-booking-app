<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl">{{ $car->name }} Details</h2>
            <a href="{{ route('admin.cars.index') }}"
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                Back to list
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        @if($car->image)
            <img src="{{ asset('storage/'.$car->image) }}" class="w-full h-64 object-cover rounded mb-4">
        @endif
        <p><strong>Brand:</strong> {{ $car->brand }}</p>
        <p><strong>Model:</strong> {{ $car->model }}</p>
        <p><strong>Year:</strong> {{ $car->year }}</p>
        <p><strong>Type:</strong> {{ $car->car_type }}</p>
        <p><strong>Price/Day:</strong> ৳{{ number_format($car->daily_rent_price,2) }}</p>
        <p><strong>Availability:</strong>
            {{ $car->availability ? 'Available' : 'Not Available' }}</p>
    </div>
</x-dashboard-layout>
