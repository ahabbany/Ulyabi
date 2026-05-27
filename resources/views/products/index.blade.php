@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <section class="py-8 bg-white border-b border-[#DDC3C3]/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-auto flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." 
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#A376A2]/30 focus:border-[#A376A2] text-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category" onchange="this.form.submit()" 
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#A376A2]/30 focus:border-[#A376A2] text-sm transition">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-48" id="subcategory-wrapper" style="{{ request('category') ? '' : 'display:none;' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subkategori</label>
                    <select name="subcategory" onchange="this.form.submit()" 
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#A376A2]/30 focus:border-[#A376A2] text-sm transition">
                        <option value="">Semua Subkategori</option>
                        @if(request('category'))
                            @php $selectedCategory = $categories->firstWhere('slug', request('category')); @endphp
                            @if($selectedCategory)
                                @foreach($selectedCategory->subcategories as $sub)
                                <option value="{{ $sub->slug }}" {{ request('subcategory') == $sub->slug ? 'selected' : '' }}>
                                    {{ $sub->name }}
                                </option>
                                @endforeach
                            @endif
                        @endif
                    </select>
                </div>
                <div class="w-full md:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                    <select name="sort" onchange="this.form.submit()" 
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#A376A2]/30 focus:border-[#A376A2] text-sm transition">
                        <option value="">Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </div>
                @if(request('search') || request('category') || request('subcategory') || request('sort'))
                <a href="{{ route('products.index') }}" class="text-sm text-[#A376A2] hover:underline whitespace-nowrap">Reset Filter</a>
                @endif
            </form>
        </div>
    </section>

    <section class="py-10 bg-[#DDC3C3] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(request('search'))
            <p class="text-gray-600 mb-6">Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></p>
            @endif

            @if($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="card-product group">
                    <div class="relative overflow-hidden">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                             class="w-full h-48 md:h-56 object-cover transition-transform duration-500 group-hover:scale-110"
                             loading="lazy">
                        @if($product->is_best_seller)
                        <span class="badge-best absolute top-3 left-3">Best Seller</span>
                        @endif
                        @if($product->is_new_arrival)
                        <span class="badge-new absolute top-3 left-3">New</span>
                        @endif
                        <form action="{{ route('cart.add') }}" method="POST" class="absolute bottom-3 right-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                        <div class="flex items-center gap-2 mt-2">
                            <a href="{{ route('products.show', $product->slug) }}" 
                               class="text-xs text-gray-500 hover:text-[#A376A2] transition flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <h3 class="text-lg font-semibold text-gray-500">Produk tidak ditemukan</h3>
                <p class="text-gray-400 mt-2">Coba gunakan kata kunci lain atau reset filter</p>
                <a href="{{ route('products.index') }}" class="btn-primary mt-6 inline-flex">Lihat Semua Produk</a>
            </div>
            @endif
        </div>
    </section>

    <script>
        document.querySelector('select[name="category"]')?.addEventListener('change', function() {
            const wrapper = document.getElementById('subcategory-wrapper');
            const subSelect = wrapper.querySelector('select');
            wrapper.style.display = this.value ? 'block' : 'none';
            
            if (this.value) {
                const category = @json($categories->keyBy('slug'));
                const subs = category[this.value]?.subcategories || [];
                subSelect.innerHTML = '<option value="">Semua Subkategori</option>' +
                    subs.map(s => `<option value="${s.slug}">${s.name}</option>`).join('');
            } else {
                subSelect.innerHTML = '<option value="">Semua Subkategori</option>';
            }
        });
    </script>
@endsection
