<x-layout>
    <x-slot name="title">Pievienot lietu</x-slot>

    <h1>Pievienot lietu</h1>

    <form method="POST" action="{{ route('items.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nosaukums</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Apraksts</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Veids</label>
            <select name="type" class="form-select">
                <option value="rent">Īre</option>
                <option value="exchange">Apmaiņa</option>
            </select>
        </div>

        <input type="hidden" name="status" value="available">

        <div class="mb-3">
            <label class="form-label">Cena</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kategorija</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Saglabāt
        </button>
    </form>
</x-layout>