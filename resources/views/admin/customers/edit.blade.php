<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Customer</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.customers.update', $customer) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block font-medium">Name</label>
                <input name="name" type="text"
                       value="{{ old('name', $customer->name) }}"
                       required
                       class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Email</label>
                <input name="email" type="email"
                       value="{{ old('email', $customer->email) }}"
                       required
                       class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Role</label>
                <select name="role" class="w-full border-gray-300 rounded p-2">
                    <option value="customer" {{ $customer->role==='customer'?'selected':'' }}>Customer</option>
                    <option value="admin"    {{ $customer->role==='admin'   ?'selected':'' }}>Admin</option>
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.customers.index') }}"
                   class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update Customer
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
