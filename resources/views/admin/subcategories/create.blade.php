@extends('admin.layouts.app')

@section('title', 'Tambah Subkategori')
@section('page-title', 'Tambah Subkategori')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="card-admin p-6">
        <form method="POST" action="{{ route('admin.subcategories.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="form-label">Nama Subkategori</label>
                <input type="text" name="name" class="form-input @error('name') border-red-400 @enderror" value="{{ old('name') }}" placeholder="Contoh: Gorengan" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Kategori Utama</label>
                <select name="category_id" class="form-input @error('category_id') border-red-400 @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-admin-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan
                </button>
                <a href="{{ route('admin.subcategories.index') }}" class="btn-admin-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
