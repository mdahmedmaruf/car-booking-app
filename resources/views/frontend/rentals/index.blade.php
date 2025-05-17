{{-- resources/views/frontend/rentals/index.blade.php --}}
<x-app-layout title="My Bookings">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h1 class="text-2xl font-bold mb-4">My Bookings</h1>

        @if($rentals->isEmpty())
            <p class="text-gray-600">You have no bookings yet.</p>
        @else
            <table class="w-full bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-gray-50 border">
                <tr>
                    <th class="p-3 text-left">Car</th>
                    <th class="p-3 text-left">Dates</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($rentals as $rental)
                    <tr>
                        <td class="p-3">{{ $rental->car->name }}</td>
                        <td class="p-3">
                            {{ $rental->start_date->format('M j, Y') }}
                            – {{ $rental->end_date->format('M j, Y') }}
                        </td>
                        <td class="p-3">৳{{ number_format($rental->total_cost,2) }}</td>
                        <td class="p-3 capitalize">{{ $rental->status }}</td>

                        <td class="p-3">
                            @if($rental->status === 'ongoing' && now()->lt($rental->start_date))
                                <form method="POST" action="{{ route('rentals.destroy', $rental) }}">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline"
                                            onclick="return confirm('Cancel this booking?')">
                                        Cancel
                                    </button>
                                </form>
                            @else
                                —
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $rentals->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
