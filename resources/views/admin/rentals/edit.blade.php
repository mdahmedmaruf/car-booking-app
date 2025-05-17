<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Rental #{{ $rental->id }}</h2>
    </x-slot>

    <div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
        <form action="{{ route('admin.rentals.update', $rental) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Dates & Cost (existing fields) --}}
            <div>
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $rental->start_date->toDateString()) }}"
                       class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label>End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date', $rental->end_date->toDateString()) }}"
                       class="w-full border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label>Total Cost</label>
                <input type="number" step="0.01" name="total_cost" value="{{ old('total_cost', $rental->total_cost) }}"
                       class="w-full border-gray-300 rounded p-2" required>
            </div>

            {{-- New: Status --}}
            <div>
                <label>Status</label>
                <select name="status" class="w-full border-gray-300 rounded p-2" required>
                    @foreach(['ongoing','completed','canceled'] as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $rental->status) === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Rental
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
