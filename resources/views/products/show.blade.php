@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <section class="py-10 bg-[#DDC3C3] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm mb-8 text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-[#A376A2] transition">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('products.index') }}" class="hover:text-[#A376A2] transition">Produk</a>
                <span class="mx-2">/</span>
                <a href="{{ route('products.index', ['category' => $product->subcategory->category->slug]) }}" class="hover:text-[#A376A2] transition">{{ $product->subcategory->category->name }}</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ $product->name }}</span>
            </nav>

            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 md:p-10">
                    <div class="relative">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                             class="w-full h-64 md:h-96 object-cover rounded-xl"
                             loading="lazy">
                        @if($product->is_best_seller)
                        <span class="badge-best absolute top-4 left-4">Best Seller</span>
                        @endif
                        @if($product->is_new_arrival)
                        <span class="badge-new absolute top-4 left-4">New</span>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-medium text-[#A376A2] bg-[#DDC3C3]/30 px-3 py-1 rounded-full">
                                {{ $product->subcategory->category->name }}
                            </span>
                            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                {{ $product->subcategory->name }}
                            </span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                        <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->description }}</p>
                        <div class="text-3xl font-bold mb-6" style="color: #6B3F69;">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        @if($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="flex items-center gap-4">
                                <label class="text-sm font-medium text-gray-700">Quantity:</label>
                                <div class="flex items-center border border-gray-200 rounded-xl">
                                    <button type="button" onclick="decrementQty()" 
                                            class="px-4 py-2 text-gray-600 hover:text-[#A376A2] transition font-bold">−</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                           class="w-16 text-center border-x border-gray-200 py-2 text-sm focus:outline-none" readonly>
                                    <button type="button" onclick="incrementQty()" 
                                            class="px-4 py-2 text-gray-600 hover:text-[#A376A2] transition font-bold">+</button>
                                </div>
                                <span class="text-xs text-gray-400">Stok: {{ $product->stock }}</span>
                            </div>
                            <button type="submit" class="btn-primary w-full justify-center text-base py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 01-8 0"></path>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                        @else
                        <div class="bg-red-50 text-red-500 px-6 py-3 rounded-xl text-sm font-medium">
                            Maaf, produk ini sedang habis.
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <h2 class="section-title text-2xl font-bold mb-8">Produk Terkait</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                    <div class="card-product group">
                        <div class="relative overflow-hidden">
                            <img src="{{ $related->image }}" alt="{{ $related->name }}" 
                                 class="w-full h-40 md:h-48 object-cover transition-transform duration-500 group-hover:scale-110"
                                 loading="lazy">
                            <form action="{{ route('cart.add') }}" method="POST" class="absolute bottom-3 right-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $related->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" 
                                        class="w-8 h-8 rounded-full bg-white shadow-lg flex items-center justify-center text-[#A376A2] hover:bg-[#A376A2] hover:text-white transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="p-3">
                            <h3 class="font-semibold text-gray-800 text-sm line-clamp-2">{{ $related->name }}</h3>
                            <p class="text-[#A376A2] font-bold text-sm mt-1">Rp{{ number_format($related->price, 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $related->slug) }}" class="text-xs text-gray-500 hover:text-[#A376A2] transition">Detail</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    <script>
        function decrementQty() {
            const input = document.getElementById('quantity');
            const val = parseInt(input.value);
            if (val > 1) input.value = val - 1;
        }
        function incrementQty() {
            const input = document.getElementById('quantity');
            const val = parseInt(input.value);
            const max = parseInt(input.max);
            if (val < max) input.value = val + 1;
        }
    </script>
@endsection
