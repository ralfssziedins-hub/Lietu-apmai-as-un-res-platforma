<x-layout>
    <x-slot name="title">Rediģēt lietu</x-slot>

    <h1>Rediģēt lietu</h1>

    <form method="POST" action="{{ route('items.update', $item) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nosaukums</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title', $item->title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Apraksts</label>
            <textarea name="description" class="form-control">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Veids</label>
            <select name="type" class="form-select">
                <option value="rent" {{ old('type', $item->type) === 'rent' ? 'selected' : '' }}>
                    Īre
                </option>
                <option value="exchange" {{ old('type', $item->type) === 'exchange' ? 'selected' : '' }}>
                    Apmaiņa
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Statuss</label>
            <select name="status" class="form-select">
                <option value="available" {{ old('status', $item->status) === 'available' ? 'selected' : '' }}>
                    Pieejama
                </option>
                <option value="reserved" {{ old('status', $item->status) === 'reserved' ? 'selected' : '' }}>
                    Rezervēta
                </option>
                <option value="rented" {{ old('status', $item->status) === 'rented' ? 'selected' : '' }}>
                    Iznomāta
                </option>
                <option value="exchanged" {{ old('status', $item->status) === 'exchanged' ? 'selected' : '' }}>
                    Apmainīta
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Cena</label>
            <input type="number" step="0.01" name="price" class="form-control"
                   value="{{ old('price', $item->price) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kategorija</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Saglabāt izmaiņas
        </button>
    </form>
</x-layout>