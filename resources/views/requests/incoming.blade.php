<x-layout>
    <x-slot name="title">Saņemtie pieprasījumi</x-slot>

    <h1>Saņemtie pieprasījumi</h1>

    @if($requests->isEmpty())
        <div class="alert alert-info">
            Nav saņemtu pieprasījumu.
        </div>
    @else
        @foreach($requests as $request)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $request->item->title }}</h5>

                    <p>
                        <strong>Pieprasītājs:</strong>
                        {{ $request->user->name }}
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
                            <strong>Piedāvā apmaiņā:</strong>
                            {{ $request->offeredItem?->title }}
                        </p>
                    @endif

                    <p>
                        <strong>Ziņa:</strong>
                        {{ $request->message }}
                    </p>

                    @if($request->status === 'pending')
                        <form method="POST"
                              action="{{ route('requests.approve', $request) }}"
                              class="d-inline">
                            @csrf
                            <button class="btn btn-success">
                                Apstiprināt
                            </button>
                        </form>

                        <form method="POST"
                              action="{{ route('requests.reject', $request) }}"
                              class="d-inline">
                            @csrf
                            <button class="btn btn-danger">
                                Noraidīt
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</x-layout>