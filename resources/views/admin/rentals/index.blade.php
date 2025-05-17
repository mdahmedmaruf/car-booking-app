<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl">Manage Rentals</h2>
            {{-- Optional: link to create a manual rental if you want --}}
             <a href="{{ route('admin.rentals.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ New Rental</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-5 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="max-w-7xl mx-auto bg-white shadow rounded-lg overflow-hidden">

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Car</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dates</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($rentals as $rental)
                    <tr>
                        <td class="px-6 py-4">{{ $rental->id }}</td>
                        <td class="px-6 py-4">{{ $rental->user->name }}</td>
                        <td class="px-6 py-4">{{ $rental->car->name }}</td>
                        <td class="px-6 py-4">
                            {{ $rental->start_date->format('M j, Y') }} – {{ $rental->end_date->format('M j, Y') }}
                        </td>
                        <td class="px-6 py-4">৳{{ number_format($rental->total_cost,2) }}</td>
                        <td class="px-6 py-4 capitalize">{{ $rental->status }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.rentals.edit', $rental) }}"
                               class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.rentals.destroy', $rental) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline"
                                        onclick="return confirm('Cancel this booking?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $rentals->links() }}
            </div>
        </div>
    </div>
</x-dashboard-layout>
