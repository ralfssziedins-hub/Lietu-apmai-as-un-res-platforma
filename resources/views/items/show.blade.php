<x-layout>
    <x-slot name="title">{{ $item->title }}</x-slot>

    <h1>{{ $item->title }}</h1>

    <p>{{ $item->description }}</p>

    <p><strong>Kategorija:</strong> {{ $item->category->name }}</p>
    <p><strong>Īpašnieks:</strong> {{ $item->user->name }}</p>
    <p><strong>Veids:</strong> {{ $item->type }}</p>
    <p><strong>Statuss:</strong> {{ $item->status }}</p>
    
        @if($item->type === 'rent')

            <p>
                <strong>Cena:</strong>
                {{ $item->price }} EUR
            </p>

        @endif
    @auth
        @if(auth()->user()->isAdmin() || auth()->id() === $item->user_id)
            <a href="{{ route('items.edit', $item) }}" class="btn btn-warning">
                Rediģēt
            </a>

            <form method="POST" action="{{ route('items.destroy', $item) }}" class="mt-2">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Dzēst
                </button>
            </form>
        @endif
    @endauth
    @auth
        @if(auth()->id() !== $item->user_id && $item->status === 'available')
            <a href="{{ route('requests.create', $item) }}" class="btn btn-primary">
                Nosūtīt pieprasījumu
            </a>
        @endif
    @endauth

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary">
            Pieslēdzies, lai nosūtītu pieprasījumu
        </a>
    @endguest
</x-layout>