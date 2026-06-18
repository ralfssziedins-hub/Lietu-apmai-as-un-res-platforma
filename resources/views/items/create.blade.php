<x-layout>
    <x-slot name="title">
        {{ __('messages.create_item') }}
    </x-slot>

    <h1>{{ __('messages.create_item') }}</h1>

    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">
                {{ __('messages.title') }}
            </label>

            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">
                {{ __('messages.description') }}
            </label>

            <textarea name="description"
                      class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">
                {{ __('messages.type') }}
            </label>

            <select name="type" class="form-select">
                <option value="rent">
                    {{ __('messages.rent') }}
                </option>

                <option value="exchange">
                    {{ __('messages.exchange') }}
                </option>
            </select>
        </div>

        <input type="hidden" name="status" value="available">

        <div class="mb-3" id="price-field">
            <label class="form-label">
                {{ __('messages.price') }}
            </label>

            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">
                {{ __('messages.category') }}
            </label>

            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
        <label class="form-label">
            {{ __('messages.image') }}
        </label>
        <input type="file"
            name="image"
            class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">
            {{ __('messages.save') }}
        </button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const typeSelect = document.querySelector('[name="type"]');
            const priceField = document.getElementById('price-field');

            function togglePrice()
            {
                if (typeSelect.value === 'exchange') {
                    priceField.style.display = 'none';
                } else {
                    priceField.style.display = 'block';
                }
            }

            togglePrice();

            typeSelect.addEventListener('change', togglePrice);
        });
    </script>

</x-layout>