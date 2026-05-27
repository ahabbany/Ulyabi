@extends('admin.layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="card-admin p-6">
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-input @error('name') border-red-400 @enderror" value="{{ old('name', $product->name) }}" required>
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-input @error('category_id') border-red-400 @enderror" required onchange="loadSubcategories(this.value)">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ($product->subcategory->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Subkategori</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-input @error('subcategory_id') border-red-400 @enderror" required>
                        <option value="">Pilih Subkategori</option>
                        @foreach($product->subcategory->category->subcategories as $sub)
                        <option value="{{ $sub->id }}" {{ $product->subcategory_id == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                    @error('subcategory_id')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-input @error('price') border-red-400 @enderror" value="{{ old('price', $product->price) }}" min="0" required>
                    @error('price')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock" class="form-input @error('stock') border-red-400 @enderror" value="{{ old('stock', $product->stock) }}" min="0" required>
                    @error('stock')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="image" id="image" class="form-input @error('image') border-red-400 @enderror" accept="image/*" onchange="previewImage(event)">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
                    @error('image')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div id="image-preview" class="hidden">
                <label class="form-label">Preview</label>
                <img id="preview" class="w-48 h-48 object-cover rounded-xl border border-gray-200">
            </div>

            @if($product->image)
            <div id="current-image">
                <label class="form-label">Foto Saat Ini</label>
                @php
                    $imageUrl = $product->image;
                    if (!\Illuminate\Support\Str::startsWith($imageUrl, 'http')) {
                        $imageUrl = \Illuminate\Support\Facades\Storage::url($imageUrl);
                    }
                @endphp
                <img src="{{ $imageUrl }}" class="w-48 h-48 object-cover rounded-xl border border-gray-200">
            </div>
            @endif

            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="4" class="form-input @error('description') border-red-400 @enderror" required>{{ old('description', $product->description) }}</textarea>
                @error('description')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_best_seller" value="1" class="w-5 h-5 rounded toggle-checkbox text-[#A376A2] focus:ring-[#A376A2]" {{ $product->is_best_seller ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700">Best Seller</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_new_arrival" value="1" class="w-5 h-5 rounded toggle-checkbox text-[#A376A2] focus:ring-[#A376A2]" {{ $product->is_new_arrival ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700">New Arrival</span>
                </label>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-admin-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Perbarui
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const preview = document.getElementById('image-preview');
        const img = document.getElementById('preview');
        const current = document.getElementById('current-image');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('hidden');
                if (current) current.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    const categories = @json($categories);

    function loadSubcategories(categoryId) {
        const select = document.getElementById('subcategory_id');
        select.innerHTML = '<option value="">Pilih Subkategori</option>';
        if (!categoryId) return;

        const cat = categories.find(c => c.id == categoryId);
        if (cat && cat.subcategories) {
            cat.subcategories.forEach(sub => {
                const option = document.createElement('option');
                option.value = sub.id;
                option.textContent = sub.name;
                if (sub.id == {{ $product->subcategory_id }}) option.selected = true;
                select.appendChild(option);
            });
        }
    }
</script>
@endpush
