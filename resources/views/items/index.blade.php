<x-layout>
    <x-slot name="title">Lietas</x-slot>

    <h1>Lietas</h1>

    @auth
        <a href="{{ route('items.create') }}" class="btn btn-success mb-3">
            Pievienot lietu
        </a>
    @endauth

    @foreach($items as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $item->title }}</h5>

                <p>{{ $item->description }}</p>

                <p>
                    <strong>Kategorija:</strong> {{ $item->category->name }}
                </p>

                <p>
                    <strong>Veids:</strong> {{ $item->type }}
                </p>

                <p>
                    <strong>Statuss:</strong> {{ $item->status }}
                </p>

                <a href="{{ route('items.show', $item) }}" class="btn btn-primary">
                    Skatīt
                </a>
            </div>
        </div>
    @endforeach
</x-layout>