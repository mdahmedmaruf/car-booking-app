<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl">Manage Cars</h2>
            <a href="{{ route('admin.cars.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + New Car
            </a>
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
        <div class="max-w-7xl mx-auto shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Brand</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price/Day</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($cars as $car)
                    <tr>
                        <td class="px-6 py-4">
                            @if($car->image)
                                <img src="{{ asset('storage/'.$car->image) }}" class="w-16 h-10 object-cover rounded">
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $car->name }}</td>
                        <td class="px-6 py-4">{{ $car->brand }}</td>
                        <td class="px-6 py-4">{{ $car->car_type }}</td>
                        <td class="px-6 py-4">৳{{ number_format($car->daily_rent_price,2) }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.cars.edit', $car) }}"
                               class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline"
                                        onclick="return confirm('Delete this car?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $cars->links() }}
            </div>
        </div>
    </div>
</x-dashboard-layout>
