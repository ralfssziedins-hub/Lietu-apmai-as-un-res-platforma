<x-layout>
    <x-slot name="title">{{ __('messages.edit_item') }}</x-slot>

    <h1>{{ __('messages.edit_item') }}</h1>

    <form method="POST"
          action="{{ route('items.update', $item) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{ __('messages.title') }}</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title', $item->title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.description') }}</label>
            <textarea name="description"
                      class="form-control">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.type') }}</label>
            <select name="type" class="form-select">
                <option value="rent" {{ old('type', $item->type) === 'rent' ? 'selected' : '' }}>
                    {{ __('messages.rent') }}
                </option>

                <option value="exchange" {{ old('type', $item->type) === 'exchange' ? 'selected' : '' }}>
                    {{ __('messages.exchange') }}
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.status') }}</label>
            <select name="status" class="form-select">
                <option value="available" {{ old('status', $item->status) === 'available' ? 'selected' : '' }}>
                    {{ __('messages.available') }}
                </option>

                <option value="reserved" {{ old('status', $item->status) === 'reserved' ? 'selected' : '' }}>
                    {{ __('messages.reserved') }}
                </option>

                <option value="rented" {{ old('status', $item->status) === 'rented' ? 'selected' : '' }}>
                    {{ __('messages.rented') }}
                </option>

                <option value="exchanged" {{ old('status', $item->status) === 'exchanged' ? 'selected' : '' }}>
                    {{ __('messages.exchanged') }}
                </option>
            </select>
        </div>

        <div class="mb-3" id="price-field">
            <label class="form-label">{{ __('messages.price') }}</label>
            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="{{ old('price', $item->price) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.category') }}</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($item->image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $item->image) }}"
                     alt="{{ $item->title }}"
                     style="max-width: 250px;">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox"
                       name="delete_image"
                       value="1"
                       class="form-check-input"
                       id="delete_image">

                <label class="form-check-label" for="delete_image">
                    {{ __('messages.delete_image') }}
                </label>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">
                {{ __('messages.image') }}
            </label>

            <input type="file"
                   name="image"
                   class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('messages.save_changes') }}
        </button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.querySelector('[name="type"]');
            const priceField = document.getElementById('price-field');
            const priceInput = document.querySelector('[name="price"]');

            function togglePrice()
            {
                if (typeSelect.value === 'exchange') {
                    priceField.style.display = 'none';
                    priceInput.value = '';
                } else {
                    priceField.style.display = 'block';
                }
            }

            togglePrice();

            typeSelect.addEventListener('change', togglePrice);
        });
    </script>
</x-layout>