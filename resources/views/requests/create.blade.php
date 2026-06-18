<x-layout>
    <x-slot name="title">{{ __('messages.send_request') }}</x-slot>

    <h1>{{ __('messages.send_request') }}</h1>

    <p><strong>{{ __('messages.item') }}:</strong> {{ $item->title }}</p>
    <p><strong>{{ __('messages.type') }}:</strong> {{ __('messages.' . $item->type) }}</p>

    <form method="POST" action="{{ route('requests.store', $item) }}">
        @csrf

        @if($item->type === 'rent')
            <div class="mb-3">
                <label class="form-label">{{ __('messages.start_date') }}</label>
                <input type="date" name="start_date" class="form-control"
                       value="{{ old('start_date') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.end_date') }}</label>
                <input type="date" name="end_date" class="form-control"
                       value="{{ old('end_date') }}">
            </div>
        @endif

        @if($item->type === 'exchange')
            <div class="mb-3">
                <label class="form-label">{{ __('messages.what_offer_exchange') }}</label>
                <select name="offered_item_id" class="form-select">
                    <option value="">{{ __('messages.choose_your_item') }}</option>
                    @foreach($myItems as $myItem)
                        <option value="{{ $myItem->id }}">
                            {{ $myItem->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">{{ __('messages.message_to_owner') }}</label>
            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('messages.send') }}
        </button>
    </form>
</x-layout>