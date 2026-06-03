@extends('admin.layouts.app')

@section('title', 'Produk')
@section('page-title', 'Produk')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" class="form-input pl-9 py-2 text-sm w-48" placeholder="Cari produk..." value="{{ request('search') }}">
                </div>
                <select name="category_id" class="form-input py-2 text-sm" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @if(request('search') || request('category_id'))
                <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary py-2 text-sm">Reset</a>
                @endif
            </form>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-admin-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Produk
        </a>
    </div>

    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-[#DDC3C3]/30">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<div class=\"w-full h-full flex items-center justify-center text-[#A376A2]\"><svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4\"/></svg></div>'">
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="font-medium text-[#6B3F69] hover:text-[#A376A2] transition">{{ $product->name }}</a>
                        </td>
                        <td>
                            <span class="text-xs text-gray-500">{{ $product->subcategory->category->name }} / {{ $product->subcategory->name }}</span>
                        </td>
                        <td class="font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-medium">{{ $product->stock }}</span>
                        </td>
                        <td>
                            <div class="flex gap-1 flex-wrap">
                                @if($product->is_best_seller)
                                <span class="badge-admin bg-yellow-100 text-yellow-800 text-xs">Best Seller</span>
                                @endif
                                @if($product->is_new_arrival)
                                <span class="badge-admin bg-green-100 text-green-800 text-xs">New</span>
                                @endif
                                @if(!$product->is_best_seller && !$product->is_new_arrival)
                                <span class="text-xs text-gray-400">-</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 rounded-lg hover:bg-gray-100 transition" title="Edit">
                                    <svg class="w-4 h-4 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg hover:bg-red-50 transition" title="Hapus">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                <p class="text-gray-400">Belum ada produk.</p>
                                <a href="{{ route('admin.products.create') }}" class="text-sm text-[#A376A2] hover:text-[#6B3F69] transition">Tambah produk pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
        <div class="px-4 py-3 border-t border-gray-100">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<style>
    nav[role="navigation"] div:first-child { display: none; }
    nav[role="navigation"] nav { display: flex; justify-content: center; gap: 0.25rem; }
    nav[role="navigation"] nav span, nav[role="navigation"] nav a {
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    nav[role="navigation"] nav span:not(.active) { color: #6B3F69; }
    nav[role="navigation"] nav span.active { background: #A376A2; color: white; }
    nav[role="navigation"] nav a { color: #6B3F69; text-decoration: none; }
    nav[role="navigation"] nav a:hover { background: rgba(163, 118, 162, 0.1); }
</style>
@endpush
