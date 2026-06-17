<x-layout>
    <x-slot name="title">
        Mans profils
    </x-slot>

    <h1>Mans profils</h1>

    <p><strong>Vārds:</strong> {{ $user->name }}</p>
    <p><strong>E-pasts:</strong> {{ $user->email }}</p>
    <p><strong>Loma:</strong> {{ $user->role }}</p>

    <h2>Manas lietas</h2>

    @if($items->isEmpty())
        <p>Tev vēl nav pievienotu lietu.</p>
    @else
        @foreach($items as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $item->title }}</h5>
                    <p>{{ $item->description }}</p>
                    <a href="{{ route('items.show', $item) }}" class="btn btn-primary">
                        Skatīt
                    </a>
                </div>
            </div>
        @endforeach
    @endif

    <h2>Saņemtās atsauksmes</h2>

    @if($receivedReviews->isEmpty())
        <p>Tev vēl nav atsauksmju.</p>
    @else
        @foreach($receivedReviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <p>
                        <strong>Vērtējums:</strong>
                        {{ $review->rating }}/5
                    </p>

                    <p>
                        <strong>Atsauksme:</strong>
                        {{ $review->text }}
                    </p>

                    <p>
                        <strong>Autors:</strong>
                        {{ $review->author->name }}
                    </p>

                    <p>
                        <strong>Par lietu:</strong>
                        {{ $review->request->item->title }}
                    </p>
                </div>
            </div>
        @endforeach
    @endif
</x-layout>