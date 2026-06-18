<x-layout>

    <x-slot name="title">
        {{ __('messages.incoming_requests') }}
    </x-slot>

    <h1>{{ __('messages.incoming_requests') }}</h1>

    @if($requests->isEmpty())

        <div class="alert alert-info">
            {{ __('messages.no_incoming_requests') }}
        </div>

    @else

        @foreach($requests as $request)

            <div class="card mb-3">

                <div class="card-body">

                    <h5>{{ $request->item->title }}</h5>

                    <p>
                        <strong>{{ __('messages.requester') }}:</strong>
                        {{ $request->user->name }}
                    </p>

                    <p>
                        <strong>{{ __('messages.status') }}:</strong>
                        {{ $request->status }}
                    </p>

                    @if($request->item->type === 'rent')

                        <p>
                            <strong>{{ __('messages.period') }}:</strong>
                            {{ $request->start_date }}
                            -
                            {{ $request->end_date }}
                        </p>

                    @endif

                    @if($request->item->type === 'exchange')

                        <p>
                            <strong>{{ __('messages.offered_exchange') }}:</strong>
                            {{ $request->offeredItem?->title }}
                        </p>

                    @endif

                    <p>
                        <strong>{{ __('messages.message') }}:</strong>
                        {{ $request->message }}
                    </p>

                    @if($request->status === 'pending')

                        <form method="POST"
                              action="{{ route('requests.approve', $request) }}"
                              class="d-inline">

                            @csrf

                            <button class="btn btn-success">
                                {{ __('messages.approve') }}
                            </button>

                        </form>

                        <form method="POST"
                              action="{{ route('requests.reject', $request) }}"
                              class="d-inline">

                            @csrf

                            <button class="btn btn-danger">
                                {{ __('messages.reject') }}
                            </button>

                        </form>

                    @endif

                </div>

            </div>

        @endforeach

    @endif

</x-layout>