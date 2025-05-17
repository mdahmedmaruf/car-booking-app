<x-front-layout title="Contact Us">
    <section class="py-16">
        <div class="max-w-md mx-auto space-y-6">
            <h1 class="text-4xl font-bold text-center">Get in Touch</h1>
            <form action="" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium">Name</label>
                    <input name="name" type="text" class="w-full border-gray-300 rounded p-2" />
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input name="email" type="email" class="w-full border-gray-300 rounded p-2" />
                </div>
                <div>
                    <label class="block text-sm font-medium">Message</label>
                    <textarea name="message" rows="4" class="w-full border-gray-300 rounded p-2"></textarea>
                </div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Send Message
                </button>
            </form>
        </div>
    </section>
</x-front-layout>
