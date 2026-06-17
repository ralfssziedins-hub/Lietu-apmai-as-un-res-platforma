<x-layout>
    <x-slot name="title">
        Mani pieprasījumi
    </x-slot>

    <h1>Mani pieprasījumi</h1>

    @if($requests->isEmpty())
        <div class="alert alert-info">
            Tev vēl nav nosūtītu pieprasījumu.
        </div>
    @else
        @foreach($requests as $request)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $request->item->title }}</h5>

                    <p>
                        <strong>Īpašnieks:</strong>
                        {{ $request->item->user->name }}
                    </p>

                    <p>
                        <strong>Statuss:</strong>
                        {{ $request->status }}
                    </p>

                    @if($request->item->type === 'rent')
                        <p>
                            <strong>Periods:</strong>
                            {{ $request->start_date }} - {{ $request->end_date }}
                        </p>
                    @endif

                    @if($request->item->type === 'exchange')
                        <p>
                            <strong>Piedāvāts apmaiņā:</strong>
                            {{ $request->offeredItem?->title }}
                        </p>
                    @endif

                    @if($request->status === 'approved')
                        <a href="{{ route('reviews.create', $request) }}"
                           class="btn btn-warning">
                            Atstāt atsauksmi
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</x-layout>