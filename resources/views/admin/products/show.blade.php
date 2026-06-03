@extends('admin.layouts.app')

@section('title', $product->name)
@section('page-title', $product->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="card-admin overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2 bg-[#DDC3C3]/20 p-8 flex items-center justify-center">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full max-w-sm rounded-xl shadow-lg" onerror="this.src='https://via.placeholder.com/400?text=No+Image'">
            </div>
            <div class="md:w-1/2 p-8">
                <div class="flex items-center gap-2 mb-2">
                    @if($product->is_best_seller)
                    <span class="badge-admin bg-yellow-100 text-yellow-800">Best Seller</span>
                    @endif
                    @if($product->is_new_arrival)
                    <span class="badge-admin bg-green-100 text-green-800">New Arrival</span>
                    @endif
                </div>

                <h1 class="text-2xl font-bold text-[#6B3F69] mb-4">{{ $product->name }}</h1>

                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-400">Kategori</p>
                        <p class="font-medium text-gray-700">{{ $product->subcategory->category->name }} / {{ $product->subcategory->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Harga</p>
                        <p class="text-2xl font-bold text-[#A376A2]">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Deskripsi</p>
                        <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-admin-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Produk
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
