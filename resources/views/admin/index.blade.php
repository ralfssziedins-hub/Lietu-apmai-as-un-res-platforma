<x-layout>
    <x-slot name="title">
        {{ __('messages.admin') }}
    </x-slot>

    <h1>{{ __('messages.admin') }}</h1>

    <h2>{{ __('messages.users') }}</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.role') }}</th>
                <th>{{ __('messages.blocked') }}</th>
                <th>{{ __('messages.action') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->is_blocked ? __('messages.yes') : __('messages.no') }}</td>
                    <td>
                        @if(! $user->isAdmin())
                            @if($user->is_blocked)
                                <form method="POST" action="{{ route('admin.users.unblock', $user) }}">
                                    @csrf
                                    <button class="btn btn-success">
                                        {{ __('messages.unblock') }}
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.block', $user) }}">
                                    @csrf
                                    <button class="btn btn-danger">
                                        {{ __('messages.block') }}
                                    </button>
                                </form>
                            @endif
                        @else
                            {{ __('messages.admin') }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>{{ __('messages.all_items') }}</h2>

    @foreach($items as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $item->title }}</h5>

                <p>
                    <strong>{{ __('messages.owner') }}:</strong>
                    {{ $item->user->name }}
                </p>

                <p>
                    <strong>{{ __('messages.category') }}:</strong>
                    {{ $item->category->name }}
                </p>

                <a href="{{ route('items.show', $item) }}" class="btn btn-primary">
                    {{ __('messages.view') }}
                </a>
            </div>
        </div>
    @endforeach

    <h2>{{ __('messages.reviews') }}</h2>

    @foreach($reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <p>
                    <strong>{{ __('messages.author') }}:</strong>
                    {{ $review->author->name }}
                </p>

                <p>
                    <strong>{{ __('messages.receiver') }}:</strong>
                    {{ $review->receiver->name }}
                </p>

                <p>
                    <strong>{{ __('messages.rating') }}:</strong>
                    {{ $review->rating }}/5
                </p>

                <p>{{ $review->text }}</p>
            </div>
        </div>
    @endforeach
</x-layout>