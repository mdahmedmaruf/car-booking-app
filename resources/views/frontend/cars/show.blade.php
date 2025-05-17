<x-front-layout title="{{ $car->name }}">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @if($car->image)
            <img src="{{ asset('storage/'.$car->image) }}"
                 alt="{{ $car->name }}"
                 class="rounded-lg w-full h-auto object-cover">
        @endif

        <div class="space-y-4">
            <h1 class="text-2xl font-bold">{{ $car->name }}</h1>
            <p><strong>Brand:</strong> {{ $car->brand }}</p>
            <p><strong>Model:</strong> {{ $car->model }}</p>
            <p><strong>Year:</strong> {{ $car->year }}</p>
            <p><strong>Type:</strong> {{ $car->car_type }}</p>
            <p class="font-semibold text-lg">৳{{ number_format($car->daily_rent_price,2) }}/day</p>

            @if($car->availability)
                <form action="{{ route('rentals.store') }}" method="POST" class="space-y-4 max-w-sm">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">

                    <div>
                        <label class="block font-medium">Start Date</label>
                        <input type="date"
                               name="start_date"
                               class="w-full border-gray-300 rounded p-2"
                               required>
                    </div>
                    <div>
                        <label class="block font-medium">End Date</label>
                        <input type="date"
                               name="end_date"
                               class="w-full border-gray-300 rounded p-2"
                               required>
                    </div>

                    <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Book Now
                    </button>
                </form>
            @else
                <p class="text-red-600 font-semibold">This car is currently unavailable.</p>
            @endif
        </div>
    </div>
</x-front-layout>
