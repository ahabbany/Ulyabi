@extends('admin.layouts.app')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="card-admin p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-input @error('name') border-red-400 @enderror" value="{{ old('name', $category->name) }}" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-admin-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 21"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Perbarui
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn-admin-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
