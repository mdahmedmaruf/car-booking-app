<x-front-layout title="Available Cars">

    <h1 class="text-2xl font-bold mb-4">Browse Cars</h1>

    {{-- Filter Form (always shown) --}}
    <form method="GET" action="{{ route('cars.index') }}"
          class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block font-medium">Brand</label>
            <select name="brand" class="w-full border-gray-300 rounded p-2">
                <option value="">All Brands</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand }}"
                        {{ request('brand') === $brand ? 'selected' : '' }}>
                        {{ $brand }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium">Type</label>
            <select name="car_type" class="w-full border-gray-300 rounded p-2">
                <option value="">All Types</option>
                @foreach($types as $type)
                    <option value="{{ $type }}"
                        {{ request('car_type') === $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium">Min Price</label>
            <input type="number" name="min_price"
                   value="{{ request('min_price') }}"
                   class="w-full border-gray-300 rounded p-2"
                   placeholder="0">
        </div>
        <div>
            <label class="block font-medium">Max Price</label>
            <input type="number" name="max_price"
                   value="{{ request('max_price') }}"
                   class="w-full border-gray-300 rounded p-2"
                   placeholder="10000">
        </div>
        <div class="md:col-span-4 text-right">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Filter
            </button>
            <a href="{{ route('cars.index') }}"
               class="ml-2 text-blue-600 hover:underline">
                Reset
            </a>
        </div>
    </form>

    {{-- No results message or Cars Grid --}}
    @if($cars->isEmpty())
        <p class="text-center text-gray-600 py-12">
            No cars found matching your criteria.
        </p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $car)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    @if($car->image)
                        <img src="{{ asset('storage/'.$car->image) }}"
                             alt="{{ $car->name }}"
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-bold">{{ $car->name }}</h3>
                        <p class="text-gray-600">{{ $car->brand }} {{ $car->model }}</p>
                        <p class="mt-2 font-semibold">৳{{ number_format($car->daily_rent_price,2) }}/day</p>
                        <a href="{{ route('cars.show', $car) }}"
                           class="mt-4 inline-block text-blue-600 hover:underline">
                            View Details →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $cars->links() }}
        </div>
    @endif

</x-front-layout>
