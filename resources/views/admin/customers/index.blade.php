<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Manage Customers</h2>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rentals</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($customers as $customer)
                    <tr>
                        <td class="px-6 py-4">{{ $customer->name }}</td>
                        <td class="px-6 py-4">{{ $customer->email }}</td>
                        <td class="px-6 py-4">{{ $customer->rentals->count() }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.customers.show', $customer) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.customers.edit', $customer) }}" class="text-green-600 hover:underline ml-2">Edit</a>
                            <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline ml-2"
                                        onclick="return confirm('Delete this customer?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</x-dashboard-layout>
