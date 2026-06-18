<x-layout>
    <x-slot name="title">{{ __('messages.items') }}</x-slot>

    <h1>{{ __('messages.items') }}</h1>

    <form method="GET" action="{{ route('items.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-5">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="{{ __('messages.search_placeholder') }}"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">
                        {{ __('messages.all_categories') }}
                    </option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary">
                    {{ __('messages.search') }}
                </button>
            </div>
        </div>
    </form>


    @if($items->isEmpty())
        <div class="alert alert-info">
            {{ __('messages.no_results') }}
        </div>
    @else
        <div class="row">
            @foreach($items as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->title }}"
                                 class="card-img-top"
                                 style="height: 180px; width: 100%; object-fit: contain">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5>{{ $item->title }}</h5>

                            <p>{{ Str::limit($item->description, 80) }}</p>

                            <p>
                                <strong>{{ __('messages.category') }}:</strong>
                                {{ $item->category->name }}
                            </p>

                            <p>
                                <strong>{{ __('messages.type') }}:</strong>
                                {{ __('messages.' . $item->type) }}
                            </p>

                            <p>
                                <strong>{{ __('messages.status') }}:</strong>
                                {{ __('messages.' . $item->status) }}
                            </p>

                            <a href="{{ route('items.show', $item) }}"
                               class="btn btn-primary mt-auto">
                                {{ __('messages.view') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $items->links() }}
        </div>
    @endif
</x-layout>