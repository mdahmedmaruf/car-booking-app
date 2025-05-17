<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Car #{{ $car->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.cars.update', $car) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div>
                    <label class="block font-medium">Name</label>
                    <input name="name" type="text"
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('name', $car->name) }}">
                </div>

                {{-- Brand --}}
                <div>
                    <label class="block font-medium">Brand</label>
                    <input name="brand" type="text"
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('brand', $car->brand) }}">
                </div>

                {{-- Model --}}
                <div>
                    <label class="block font-medium">Model</label>
                    <input name="model" type="text"
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('model', $car->model) }}">
                </div>

                {{-- Year --}}
                <div>
                    <label class="block font-medium">Year</label>
                    <input name="year" type="number"
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('year', $car->year) }}">
                </div>

                {{-- Car Type --}}
                <div>
                    <label class="block font-medium">Car Type</label>
                    <input name="car_type" type="text"
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('car_type', $car->car_type) }}">
                </div>

                {{-- Daily Rent Price --}}
                <div>
                    <label class="block font-medium">Daily Rent Price</label>
                    <input name="daily_rent_price" type="number" step="0.01"
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('daily_rent_price', $car->daily_rent_price) }}">
                </div>

                {{-- Availability --}}
                <div>
                    <label class="block font-medium">Availability</label>
                    <select name="availability" class="w-full border-gray-300 rounded p-2">
                        <option value="1" {{ old('availability', $car->availability) == 1 ? 'selected' : '' }}>
                            Available
                        </option>
                        <option value="0" {{ old('availability', $car->availability) == 0 ? 'selected' : '' }}>
                            Not Available
                        </option>
                    </select>
                </div>

                {{-- Image --}}
                <div>
                    <label class="block font-medium">Image</label>
                    @if($car->image)
                        <img src="{{ asset('storage/'.$car->image) }}"
                             class="w-32 h-20 object-cover rounded mb-2">
                    @endif
                    <input name="image" type="file" accept="image/*"
                           class="w-full border-gray-300 rounded p-2">
                </div>

                {{-- Actions --}}
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('admin.cars.index') }}"
                       class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update Car
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
