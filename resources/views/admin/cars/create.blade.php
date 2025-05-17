<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add New Car</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-medium">Name</label>
                    <input name="name" type="text" required
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('name') }}">
                </div>
                <div>
                    <label class="block font-medium">Brand</label>
                    <input name="brand" type="text" required
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('brand') }}">
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block font-medium">Model</label>
                        <input name="model" type="text" required
                               class="w-full border-gray-300 rounded p-2"
                               value="{{ old('model') }}">
                    </div>
                    <div>
                        <label class="block font-medium">Year</label>
                        <input name="year" type="number" required
                               class="w-full border-gray-300 rounded p-2"
                               value="{{ old('year') }}">
                    </div>
                    <div>
                        <label class="block font-medium">Type</label>
                        <input name="car_type" type="text" required
                               class="w-full border-gray-300 rounded p-2"
                               value="{{ old('car_type') }}">
                    </div>
                </div>
                <div>
                    <label class="block font-medium">Daily Rent Price</label>
                    <input name="daily_rent_price" type="number" step="0.01" required
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('daily_rent_price') }}">
                </div>
                <div>
                    <label class="block font-medium">Availability</label>
                    <select name="availability" class="w-full border-gray-300 rounded p-2">
                        <option value="1" {{ old('availability')=='1'?'selected':'' }}>Available</option>
                        <option value="0" {{ old('availability')=='0'?'selected':'' }}>Not Available</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium">Image</label>
                    <input name="image" type="file" accept="image/*"
                           class="w-full border-gray-300 rounded p-2">
                </div>
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('admin.cars.index') }}"
                       class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Save Car
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
