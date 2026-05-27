@extends('admin.layouts.app')

@section('title', 'Subkategori')
@section('page-title', 'Subkategori')

@section('content')
<div class="space-y-6">
    <div class="flex justify-end">
        <a href="{{ route('admin.subcategories.create') }}" class="btn-admin-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Subkategori
        </a>
    </div>

    <div class="card-admin overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>Nama Subkategori</th>
                        <th>Slug</th>
                        <th>Kategori Utama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subcategories as $subcategory)
                    <tr>
                        <td class="font-medium text-gray-700">{{ $subcategory->name }}</td>
                        <td><code class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $subcategory->slug }}</code></td>
                        <td>
                            <span class="badge-admin bg-[#A376A2]/10 text-[#A376A2]">{{ $subcategory->category->name }}</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" class="p-2 rounded-lg hover:bg-gray-100 transition" title="Edit">
                                    <svg class="w-4 h-4 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" onsubmit="return confirm('Yakin ingin menghapus subkategori ini? Semua produk di dalamnya juga akan terhapus.')">
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
                        <td colspan="4" class="text-center py-12">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                <p class="text-gray-400">Belum ada subkategori.</p>
                                <a href="{{ route('admin.subcategories.create') }}" class="text-sm text-[#A376A2] hover:text-[#6B3F69] transition">Tambah subkategori pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($subcategories->hasPages())
        <div class="px-4 py-3 border-t border-gray-100">
            {{ $subcategories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
