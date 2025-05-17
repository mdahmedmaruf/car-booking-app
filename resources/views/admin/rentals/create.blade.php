<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add New Rental</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rentals.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Customer</label>
                <select name="user_id" class="w-full border-gray-300 rounded p-2">
                    <option value="">Select a customer</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" {{ old('user_id')==$c->id?'selected':'' }}>
                            {{ $c->name }} ({{ $c->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Car</label>
                <select name="car_id" class="w-full border-gray-300 rounded p-2">
                    <option value="">Select a car</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ old('car_id')==$car->id?'selected':'' }}>
                            {{ $car->name }} – ৳{{ number_format($car->daily_rent_price,2) }}/day
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Start Date</label>
                    <input name="start_date" type="date"
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('start_date') }}">
                </div>
                <div>
                    <label class="block font-medium">End Date</label>
                    <input name="end_date" type="date"
                           class="w-full border-gray-300 rounded p-2"
                           value="{{ old('end_date') }}">
                </div>
            </div>

            <div>
                <label class="block font-medium">Total Cost</label>
                <input name="total_cost" type="number" step="0.01"
                       class="w-full border-gray-300 rounded p-2"
                       value="{{ old('total_cost') }}">
            </div>

            <div>
                <label class="block font-medium">Status</label>
                <select name="status" class="w-full border-gray-300 rounded p-2">
                    <option value="ongoing"   {{ old('status')=='ongoing'   ?'selected':'' }}>Ongoing</option>
                    <option value="completed" {{ old('status')=='completed' ?'selected':'' }}>Completed</option>
                    <option value="canceled"  {{ old('status')=='canceled'  ?'selected':'' }}>Canceled</option>
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.rentals.index') }}"
                   class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Create Rental
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
