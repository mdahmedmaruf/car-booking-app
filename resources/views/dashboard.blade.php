<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (Auth::user()->isAdmin())
                {{-- — Admin Overview Cards — --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-4">
                    <div class="bg-white shadow rounded-lg p-4">
                        <h3 class="text-sm font-medium">Total Cars</h3>
                        <p class="mt-2 text-3xl font-bold">{{ $totalCars }}</p>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4">
                        <h3 class="text-sm font-medium">Available Cars</h3>
                        <p class="mt-2 text-3xl font-bold">{{ $availableCars }}</p>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4">
                        <h3 class="text-sm font-medium">Total Rentals</h3>
                        <p class="mt-2 text-3xl font-bold">{{ $totalRentals }}</p>
                    </div>
                    {{-- After Total Rentals card, before Total Earnings --}}
                    <div class="bg-white shadow rounded-lg p-4">
                        <h3 class="text-sm font-medium">Pending Rentals</h3>
                        <p class="mt-2 text-3xl font-bold">{{ $pendingRentals }}</p>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4">
                        <h3 class="text-sm font-medium">Total Earnings</h3>
                        <p class="mt-2 text-3xl font-bold">৳{{ number_format($totalEarnings,2) }}</p>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4">
                        <h3 class="text-sm font-medium">Customers</h3>
                        <p class="mt-2 text-3xl font-bold">{{ $customersCount }}</p>
                    </div>
                </div>

                {{-- — Recent Bookings Table — --}}
                <div class="mt-8 px-4">
                    <h3 class="text-lg font-medium">Recent Bookings</h3>
                    <table class="w-full mt-4 bg-white shadow rounded-lg">
                        <thead class="bg-gray-100 border">
                        <tr>
                            <th class="p-3 text-start">Customer</th>
                            <th class="p-3 text-start">Car</th>
                            <th class="p-3 text-start">Dates</th>
                            <th class="p-3 text-start">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($recentBookings as $r)
                            <tr class="border-t">
                                <td class="p-3">{{ $r->user->name }}</td>
                                <td class="p-3">{{ $r->car->name }}</td>
                                <td class="p-3">
                                    {{ $r->start_date->format('M j, Y') }} – {{ $r->end_date->format('M j, Y') }}
                                </td>
                                <td class="p-3">৳{{ number_format($r->total_cost,2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                {{-- — Customer Bookings List — --}}
                <div>
                    <h3 class="text-lg font-medium">My Bookings</h3>
                    @if ($myBookings->isEmpty())
                        <p class="mt-4 text-gray-600">You have no bookings yet.</p>
                    @else
                        <table class="w-full mt-4 bg-white shadow rounded-lg">
                            <thead class="bg-gray-100 border">
                            <tr>
                                <th class="p-3 text-start">Car</th>
                                <th class="p-3 text-start">Dates</th>
                                <th class="p-3 text-start">Total</th>
                                <th class="p-3 text-start">Status</th>
                                <th class="p-3 text-start">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($myBookings as $rental)
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
                            {{ $myBookings->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>



</x-dashboard-layout>



