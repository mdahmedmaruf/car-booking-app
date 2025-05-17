<x-front-layout title="Home">
    {{-- Hero Section --}}
    <section class="w-full relative bg-cover bg-center h-[50vh]" style="background-image:url('https://images.pexels.com/photos/16028417/pexels-photo-16028417/free-photo-of-red-mazda-3.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
            <h1 class="text-5xl font-bold mb-4">Find Your Perfect Ride</h1>
            <p class="text-lg mb-6 max-w-xl">Browse our fleet of top-quality cars and book in seconds, cash-on-delivery.</p>
            <a href="{{ route('cars.index') }}"
               class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg text-white font-semibold">
                Browse Cars
            </a>
        </div>
    </section>

    {{-- All Cars Section --}}
    <section id="cars" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Our Cars</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($cars as $car)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        @if($car->image)
                            <img src="{{ asset('storage/'.$car->image) }}"
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $car->name }}</h3>
                            <p class="text-gray-600">{{ $car->brand }} {{ $car->model }}</p>
                            <p class="mt-2 font-bold">৳{{ number_format($car->daily_rent_price,2) }}/day</p>
                            <a href="{{ route('cars.show', $car) }}"
                               class="mt-4 inline-block text-blue-600 hover:underline">
                                View Details →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Team Section --}}
    <section id="team" class="py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-8">Meet the Team</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach([
                  ['name'=>'Alice','role'=>'Founder','img'=>'/images/team1.jpg'],
                  ['name'=>'Bob','role'=>'Operations','img'=>'/images/team2.jpg'],
                  ['name'=>'Carol','role'=>'Marketing','img'=>'/images/team3.jpg'],
                  ['name'=>'Dave','role'=>'Customer Support','img'=>'/images/team4.jpg'],
                ] as $member)
                    <div class="bg-white shadow rounded-lg p-6">
                        <img src="{{ $member['img'] }}" alt="{{ $member['name'] }}"
                             class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-semibold">{{ $member['name'] }}</h3>
                        <p class="text-gray-500">{{ $member['role'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section id="testimonials" class="py-16 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-8">What Our Customers Say</h2>
            <div class="space-y-8">
                @foreach([
                  ['quote'=>'Great service and friendly staff!','author'=>'Emily'],
                  ['quote'=>'Cars were in perfect condition.','author'=>'John'],
                  ['quote'=>'Booking process was super easy.','author'=>'Sara'],
                ] as $t)
                    <blockquote class="bg-white shadow rounded-lg p-6 italic">
                        “{{ $t['quote'] }}”
                        <footer class="mt-4 font-semibold text-gray-700">— {{ $t['author'] }}</footer>
                    </blockquote>
                @endforeach
            </div>
        </div>
    </section>
</x-front-layout>
