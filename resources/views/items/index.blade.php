<x-layout>
    <x-slot name="title">{{ __('messages.items') }}</x-slot>

    <h1>{{ __('messages.items') }}</h1>

    <form method="GET" action="{{ route('items.index') }}" class="mb-4">
        <div class="row">
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

    @auth
        <a href="{{ route('items.create') }}" class="btn btn-success mb-3">
            {{ __('messages.create_item') }}
        </a>
    @endauth

    @if($items->isEmpty())
        <div class="alert alert-info">
            {{ __('messages.no_results') }}
        </div>
    @else
        @foreach($items as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $item->title }}</h5>

                    <p>{{ $item->description }}</p>

                    <p>
                        <strong>{{ __('messages.category') }}:</strong>
                        {{ $item->category->name }}
                    </p>

                    <p>
                        <strong>{{ __('messages.type') }}:</strong>
                        {{ __('messages.'.$item->type) }}
                    </p>

                    <p>
                        <strong>{{ __('messages.status') }}:</strong>
                        {{ __('messages.'.$item->status) }}
                    </p>

                    <a href="{{ route('items.show', $item) }}" class="btn btn-primary">
                        {{ __('messages.view') }}
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</x-layout>