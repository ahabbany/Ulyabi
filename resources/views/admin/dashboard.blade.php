@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-gray-500 text-sm">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        <span class="text-xs text-gray-400">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #A376A2, #8D5F8C);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/70 text-xs font-medium uppercase tracking-wider">Total Produk</p>
                    <p class="text-white text-3xl font-bold mt-1">{{ $totalProducts }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #6B3F69, #5B2C59);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/70 text-xs font-medium uppercase tracking-wider">Total Kategori</p>
                    <p class="text-white text-3xl font-bold mt-1">{{ $totalCategories }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #8D5F8C, #A376A2);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/70 text-xs font-medium uppercase tracking-wider">Total Subkategori</p>
                    <p class="text-white text-3xl font-bold mt-1">{{ $totalSubcategories }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #DDC3C3, #C9A3A3);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#6B3F69]/70 text-xs font-medium uppercase tracking-wider">Best Seller</p>
                    <p class="text-[#6B3F69] text-3xl font-bold mt-1">{{ $totalBestSellers }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#6B3F69]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
            </div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #E8D5D5, #DDC3C3);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#6B3F69]/70 text-xs font-medium uppercase tracking-wider">New Arrival</p>
                    <p class="text-[#6B3F69] text-3xl font-bold mt-1">{{ $totalNewArrivals }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#6B3F69]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card-admin p-6">
            <h3 class="text-lg font-semibold text-[#6B3F69] mb-4">Produk per Kategori</h3>
            <div class="space-y-4">
                @forelse($productsPerCategory as $category)
                <div>
                    <div class="flex justify-between text-sm mb-1.5">
                        <span class="font-medium text-gray-700">{{ $category->name }}</span>
                        <span class="text-gray-500">{{ $category->products_count }} produk</span>
                    </div>
                    <div class="w-full bg-[#DDC3C3]/30 rounded-full h-2.5 overflow-hidden">
                        @php
                            $maxCount = $productsPerCategory->max('products_count');
                            $percentage = $maxCount > 0 ? ($category->products_count / $maxCount) * 100 : 0;
                            $gradients = ['#A376A2', '#6B3F69', '#8D5F8C', '#DDC3C3'];
                            $gradient = $gradients[$loop->index % count($gradients)];
                        @endphp
                        <div class="h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%; background: {{ $gradient }};"></div>
                    </div>
                </div>
                @empty
                <p class="text-gray-400 text-sm text-center py-8">Belum ada data kategori.</p>
                @endforelse
            </div>
        </div>

        <div class="card-admin p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-[#6B3F69]">Produk Terbaru</h3>
                <a href="{{ route('admin.products.index') }}" class="text-sm text-[#A376A2] hover:text-[#6B3F69] transition">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                @forelse($recentProducts as $product)
                <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#F7EFE5] transition">
                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-[#DDC3C3]/30 flex-shrink-0">
                        @php
                            $imageUrl = $product->image;
                            if (!\Illuminate\Support\Str::startsWith($imageUrl, 'http')) {
                                $imageUrl = \Illuminate\Support\Facades\Storage::url($imageUrl);
                            }
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<div class=\"w-full h-full flex items-center justify-center text-[#A376A2]\"><svg class=\"w-6 h-6\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4\"/></svg></div>'">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-700 truncate">{{ $product->name }}</p>
                        <p class="text-xs text-gray-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex gap-1">
                        @if($product->is_best_seller)
                        <span class="badge-admin bg-yellow-100 text-yellow-800">Best</span>
                        @endif
                        @if($product->is_new_arrival)
                        <span class="badge-admin bg-green-100 text-green-800">New</span>
                        @endif
                    </div>
                </div>
                @empty
                <p class="text-gray-400 text-sm text-center py-8">Belum ada produk.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (el) { return new bootstrap.Tooltip(el) })
</script>
@endpush
