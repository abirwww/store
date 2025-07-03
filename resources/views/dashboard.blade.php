<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-xl font-bold mb-4">Uploaded Products</h3>

                    @if($products->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <div class="border rounded-lg p-4 shadow">
                                    <h4 class="font-semibold mb-2">{{ $product->name }}</h4>
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No products uploaded yet.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
