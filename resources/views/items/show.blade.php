<x-layout>
    <x-slot name="title">{{ $item->title }}</x-slot>

    <h1>{{ $item->title }}</h1>

    <p>{{ $item->description }}</p>

    <p><strong>{{ __('messages.category') }}:</strong> {{ $item->category->name }}</p>
    <p><strong>{{ __('messages.owner') }}:</strong> {{ $item->user->name }}</p>
    <p><strong>{{ __('messages.type') }}:</strong> {{ __('messages.'.$item->type) }}</p>
    <p><strong>{{ __('messages.status') }}:</strong> {{ __('messages.'.$item->status) }}</p>

    @if($item->type === 'rent')
        <p>
            <strong>{{ __('messages.price') }}:</strong>
            {{ $item->price }} EUR
        </p>
    @endif

    @auth
        @if(auth()->user()->isAdmin() || auth()->id() === $item->user_id)
            <a href="{{ route('items.edit', $item) }}" class="btn btn-warning">
                {{ __('messages.edit') }}
            </a>

            <form method="POST" action="{{ route('items.destroy', $item) }}" class="mt-2">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    {{ __('messages.delete') }}
                </button>
            </form>
        @endif
    @endauth

    @auth
        @if(auth()->id() !== $item->user_id && $item->status === 'available')
            <a href="{{ route('requests.create', $item) }}" class="btn btn-primary">
                {{ __('messages.send_request') }}
            </a>
        @endif
    @endauth

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary">
            {{ __('messages.login_to_request') }}
        </a>
    @endguest
</x-layout>