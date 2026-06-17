<x-layout>
    <x-slot name="title">
        Admin panelis
    </x-slot>

    <h1>Admin panelis</h1>

    <h2>Lietotāji</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Vārds</th>
                <th>E-pasts</th>
                <th>Loma</th>
                <th>Bloķēts</th>
                <th>Darbība</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->is_blocked ? 'Jā' : 'Nē' }}</td>
                    <td>
                        @if(! $user->isAdmin())
                            @if($user->is_blocked)
                                <form method="POST" action="{{ route('admin.users.unblock', $user) }}">
                                    @csrf
                                    <button class="btn btn-success">
                                        Atbloķēt
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.block', $user) }}">
                                    @csrf
                                    <button class="btn btn-danger">
                                        Bloķēt
                                    </button>
                                </form>
                            @endif
                        @else
                            Admin
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Visas lietas</h2>

    @foreach($items as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $item->title }}</h5>
                <p><strong>Īpašnieks:</strong> {{ $item->user->name }}</p>
                <p><strong>Kategorija:</strong> {{ $item->category->name }}</p>

                <a href="{{ route('items.show', $item) }}" class="btn btn-primary">
                    Skatīt
                </a>
            </div>
        </div>
    @endforeach

    <h2>Atsauksmes</h2>

    @foreach($reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Autors:</strong> {{ $review->author->name }}</p>
                <p><strong>Saņēmējs:</strong> {{ $review->receiver->name }}</p>
                <p><strong>Vērtējums:</strong> {{ $review->rating }}/5</p>
                <p>{{ $review->text }}</p>
            </div>
        </div>
    @endforeach
</x-layout>