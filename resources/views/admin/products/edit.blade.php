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
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="image" id="image" class="form-input @error('image') border-red-400 @enderror" accept="image/*" onchange="previewImage(event)">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
                    @error('image')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div id="image-preview" class="hidden">
                <label class="form-label">Preview Baru</label>
                <img id="preview" class="w-48 h-48 object-cover rounded-xl border border-gray-200">
            </div>

            @if($product->image)
            <div id="current-image">
                <label class="form-label">Foto Saat Ini</label>
                <img src="{{ asset($product->image) }}" class="w-48 h-48 object-cover rounded-xl border border-gray-200">
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

            <div>
                <div class="flex items-center justify-between mb-3">
                    <label class="form-label mb-0">Varian Produk <span class="text-xs text-gray-400 font-normal">(opsional)</span></label>
                    <button type="button" onclick="addVariant()" class="text-sm text-[#A376A2] hover:text-[#6B3F69] transition font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Varian
                    </button>
                </div>
                <div id="variants-container" class="space-y-3">
                    @forelse($product->variants as $variant)
                    <div class="variant-row flex items-start gap-3 p-3 bg-gray-50 rounded-xl" data-index="{{ $loop->index }}">
                        <div class="flex-1">
                            <input type="text" name="variants[{{ $loop->index }}][name]" value="{{ $variant->name }}"
                                   class="form-input py-2 text-sm" placeholder="Nama varian (misal: Pisang Coklat)" required>
                        </div>
                        <div class="w-36">
                            <input type="number" name="variants[{{ $loop->index }}][additional_price]" value="{{ $variant->additional_price }}"
                                   class="form-input py-2 text-sm" placeholder="Tambahan harga" min="0">
                        </div>
                        <button type="button" onclick="removeVariant(this)" class="p-2 text-gray-400 hover:text-red-500 transition mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                    @empty
                    <p class="text-xs text-gray-400">Biarkan kosong jika produk tidak memiliki varian.</p>
                    @endforelse
                </div>
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
    let variantIndex = {{ $product->variants->count() }};

    function addVariant(name = '', additionalPrice = '') {
        const container = document.getElementById('variants-container');
        const emptyMsg = container.querySelector('p.text-xs');
        if (emptyMsg) emptyMsg.remove();

        const div = document.createElement('div');
        div.className = 'variant-row flex items-start gap-3 p-3 bg-gray-50 rounded-xl';
        div.dataset.index = variantIndex;
        div.innerHTML = `
            <div class="flex-1">
                <input type="text" name="variants[${variantIndex}][name]" value="${name}"
                       class="form-input py-2 text-sm" placeholder="Nama varian (misal: Pisang Coklat)" required>
            </div>
            <div class="w-36">
                <input type="number" name="variants[${variantIndex}][additional_price]" value="${additionalPrice}"
                       class="form-input py-2 text-sm" placeholder="Tambahan harga" min="0">
            </div>
            <button type="button" onclick="removeVariant(this)" class="p-2 text-gray-400 hover:text-red-500 transition mt-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        `;
        container.appendChild(div);
        variantIndex++;
    }

    function removeVariant(btn) {
        btn.closest('.variant-row').remove();
        const container = document.getElementById('variants-container');
        if (!container.querySelector('.variant-row')) {
            container.innerHTML = '<p class="text-xs text-gray-400">Biarkan kosong jika produk tidak memiliki varian.</p>';
        }
    }

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
