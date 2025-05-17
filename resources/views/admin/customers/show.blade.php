<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Customer Details</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <p><strong>Name:</strong> {{ $customer->name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($customer->role) }}</p>

        <h3 class="mt-6 text-lg font-medium">Rental History</h3>
        @if($customer->rentals->isEmpty())
            <p class="text-gray-600">No rentals found.</p>
        @else
            <table class="w-full mt-4 bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left">Car</th>
                    <th class="p-3 text-left">Dates</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($customer->rentals as $rental)
                    <tr>
                        <td class="p-3">{{ $rental->car->name }}</td>
                        <td class="p-3">
                            {{ $rental->start_date->format('M j, Y') }} – {{ $rental->end_date->format('M j, Y') }}
                        </td>
                        <td class="p-3">৳{{ number_format($rental->total_cost,2) }}</td>
                        <td class="p-3 capitalize">{{ $rental->status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-dashboard-layout>
