@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="hero-gradient relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    Manisnya <span class="text-[#DDC3C3]">Kebahagiaan</span><br>
                    dalam Setiap Gigitan
                </h1>
                <p class="text-lg md:text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                    Temukan aneka snack, cake, dan catering rumahan terbaik dari Ulyabi. 
                    Dibuat dengan cinta dan bahan-bahan berkualitas.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="btn-primary bg-white text-[#6B3F69] hover:bg-[#DDC3C3] hover:text-[#6B3F69] shadow-lg text-base px-8 py-4">
                        Lihat Produk
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="https://wa.me/6285600552040" target="_blank" class="btn-secondary border-white text-white hover:bg-white hover:text-[#6B3F69] text-base px-8 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute -bottom-1 left-0 right-0">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 100L1440 0V100H0Z" fill="#DDC3C3"/>
            </svg>
        </div>
    </section>

    <section class="py-16 bg-[#DDC3C3]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="section-title text-3xl md:text-4xl">Kategori Produk</h2>
                <p class="text-gray-600 mt-4">Pilih kategori favoritmu</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                   class="group bg-white rounded-2xl p-8 text-center shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl transition-transform group-hover:scale-110"
                         style="background: linear-gradient(135deg, #A376A2, #6B3F69);">
                        @switch($category->slug)
                            @case('snack')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 010 8h-1"></path><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                                @break
                            @case('cake')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-8a2 2 0 00-2-2H6a2 2 0 00-2 2v8"></path><path d="M4 16s.5-1 2-1 2 1 2 1 1-1 2-1 2 1 2 1 1-1 2-1 2 1 2 1 1-1 2-1 2 1 2 1"></path><path d="M2 21h20"></path><path d="M12 3v5"></path><path d="M10 3h4"></path></svg>
                                @break
                            @case('strudel')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11h18"></path><path d="M7 7v2"></path><path d="M17 7v2"></path><path d="M12 3v4"></path><path d="M4 11v8a2 2 0 002 2h12a2 2 0 002-2v-8"></path></svg>
                                @break
                            @case('catering')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z"></path><path d="M3 9h18"></path><path d="M9 3v18"></path></svg>
                                @break
                        @endswitch
                    </div>
                    <h3 class="font-semibold text-gray-800 group-hover:text-[#A376A2] transition">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $category->subcategories->count() }} Subkategori</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    @if($bestSellers->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="section-title text-3xl md:text-4xl">Best Seller</h2>
                <p class="text-gray-600 mt-4">Produk paling laris dari Ulyabi</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($bestSellers as $product)
                <div class="card-product group">
                    <div class="relative overflow-hidden">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                             class="w-full h-48 md:h-56 object-cover transition-transform duration-500 group-hover:scale-110"
                             loading="lazy">
                        <span class="badge-best absolute top-3 left-3">Best Seller</span>
                        <form action="{{ route('cart.add') }}" method="POST" class="absolute bottom-3 right-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="variant_id" value="0">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" 
                                    class="w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-[#A376A2] hover:bg-[#A376A2] hover:text-white transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="p-4">
                        <span class="text-xs font-medium text-[#A376A2] bg-[#DDC3C3]/30 px-2 py-1 rounded-full">{{ $product->subcategory->category->name }}</span>
                        <h3 class="font-semibold text-gray-800 mt-2 text-sm md:text-base line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-[#A376A2] font-bold mt-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product->slug) }}" class="text-xs text-gray-500 hover:text-[#A376A2] mt-2 inline-block transition">Lihat Detail</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('products.index', ['sort' => 'best_seller']) }}" class="btn-primary">Lihat Semua Best Seller</a>
            </div>
        </div>
    </section>
    @endif

    @if($newArrivals->count() > 0)
    <section class="py-16 bg-[#DDC3C3]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="section-title text-3xl md:text-4xl">New Arrivals</h2>
                <p class="text-gray-600 mt-4">Produk terbaru dari Ulyabi</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($newArrivals as $product)
                <div class="card-product group">
                    <div class="relative overflow-hidden">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                             class="w-full h-48 md:h-56 object-cover transition-transform duration-500 group-hover:scale-110"
                             loading="lazy">
                        <span class="badge-new absolute top-3 left-3">New</span>
                        <form action="{{ route('cart.add') }}" method="POST" class="absolute bottom-3 right-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="variant_id" value="0">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" 
                                    class="w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-[#A376A2] hover:bg-[#A376A2] hover:text-white transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="p-4">
                        <span class="text-xs font-medium text-[#A376A2] bg-[#DDC3C3]/30 px-2 py-1 rounded-full">{{ $product->subcategory->category->name }}</span>
                        <h3 class="font-semibold text-gray-800 mt-2 text-sm md:text-base line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-[#A376A2] font-bold mt-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product->slug) }}" class="text-xs text-gray-500 hover:text-[#A376A2] mt-2 inline-block transition">Lihat Detail</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="btn-primary">Lihat Semua Produk</a>
            </div>
        </div>
    </section>
    @endif

    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color: #6B3F69;">Siap Pesan?</h2>
            <p class="text-gray-600 mb-8 max-w-lg mx-auto">
                Pesan sekarang melalui WhatsApp dan nikmati kelezatan produk Ulyabi!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="btn-primary text-base px-8 py-4">
                    Mulai Belanja
                </a>
                <a href="https://wa.me/6285600552040" target="_blank" class="btn-secondary text-base px-8 py-4">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
