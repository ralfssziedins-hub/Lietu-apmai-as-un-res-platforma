<x-layout>

    <x-slot name="title">
        {{ __('messages.my_requests') }}
    </x-slot>

    <h1>{{ __('messages.my_requests') }}</h1>

    @if($requests->isEmpty())

        <div class="alert alert-info">
            {{ __('messages.no_my_requests') }}
        </div>

    @else

        @foreach($requests as $request)

            <div class="card mb-3">

                <div class="card-body">

                    <h5>{{ $request->item->title }}</h5>

                    <p>
                        <strong>{{ __('messages.owner') }}:</strong>
                        {{ $request->item->user->name }}
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

                    @if($request->status === 'approved')

                        <a href="{{ route('reviews.create', $request) }}"
                           class="btn btn-warning">
                            {{ __('messages.leave_review') }}
                        </a>

                    @endif

                </div>

            </div>

        @endforeach

    @endif

</x-layout>