@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
    <section class="py-10 bg-[#DDC3C3] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-8" style="color: #6B3F69;">Keranjang Belanja</h1>

            @if($products->count() > 0)
            <div class="space-y-4">
                @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-sm p-4 md:p-6 flex flex-col sm:flex-row gap-4 items-start">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                         class="w-full sm:w-24 h-24 object-cover rounded-xl">
                    <div class="flex-1 w-full">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $product->subcategory->category->name }} - {{ $product->subcategory->name }}</p>
                                <p class="text-[#A376A2] font-bold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="flex items-center border border-gray-200 rounded-xl">
                                    <button type="submit" name="quantity" value="{{ $product->cart_quantity - 1 }}"
                                            class="px-3 py-1.5 text-gray-600 hover:text-[#A376A2] transition font-bold text-sm">−</button>
                                    <span class="px-4 py-1.5 text-sm font-medium border-x border-gray-200">{{ $product->cart_quantity }}</span>
                                    <button type="submit" name="quantity" value="{{ $product->cart_quantity + 1 }}"
                                            class="px-3 py-1.5 text-gray-600 hover:text-[#A376A2] transition font-bold text-sm">+</button>
                                </div>
                            </form>
                            <p class="font-semibold" style="color: #6B3F69;">
                                Rp{{ number_format($product->subtotal, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-lg font-semibold text-gray-800">Total Belanja</span>
                    <span class="text-2xl font-bold" style="color: #6B3F69;">Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary w-full justify-center text-base py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Checkout via WhatsApp
                    </button>
                </form>
            </div>
            @else
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-300 mb-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 01-8 0"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-500 mb-2">Keranjang Kosong</h3>
                <p class="text-gray-400 mb-6">Yuk, mulai belanja produk Ulyabi!</p>
                <a href="{{ route('products.index') }}" class="btn-primary">Lihat Produk</a>
            </div>
            @endif
        </div>
    </section>
@endsection
