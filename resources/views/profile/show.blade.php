<x-layout>
    <x-slot name="title">
        {{ __('messages.profile') }}
    </x-slot>

    <h1>{{ __('messages.profile') }}</h1>

    <p><strong>{{ __('messages.name') }}:</strong> {{ $user->name }}</p>
    <p><strong>{{ __('messages.email') }}:</strong> {{ $user->email }}</p>
    <p><strong>{{ __('messages.role') }}:</strong> {{ $user->role }}</p>

    <h2>{{ __('messages.my_items') }}</h2>

    @if($items->isEmpty())
        <p>{{ __('messages.no_items') }}</p>
    @else
        @foreach($items as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $item->title }}</h5>
                    <p>{{ $item->description }}</p>

                    <a href="{{ route('items.show', $item) }}" class="btn btn-primary">
                        {{ __('messages.view') }}
                    </a>
                </div>
            </div>
        @endforeach
    @endif

    <h2>{{ __('messages.received_reviews') }}</h2>

    @if($receivedReviews->isEmpty())
        <p>{{ __('messages.no_reviews') }}</p>
    @else
        @foreach($receivedReviews as $review)
            <div class="card mb-3">
                <div class="card-body">

                    <p>
                        <strong>{{ __('messages.rating') }}:</strong>
                        {{ $review->rating }}/5
                    </p>

                    <p>
                        <strong>{{ __('messages.review') }}:</strong>
                        {{ $review->text }}
                    </p>

                    <p>
                        <strong>{{ __('messages.author') }}:</strong>
                        {{ $review->author->name }}
                    </p>

                    <p>
                        <strong>{{ __('messages.for_item') }}:</strong>
                        {{ $review->request->item->title }}
                    </p>

                </div>
            </div>
        @endforeach
    @endif
</x-layout>