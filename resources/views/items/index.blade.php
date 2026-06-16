<x-layout>
    <x-slot name="title">Lietas</x-slot>

    <h1>Lietas</h1>
        <form method="GET" action="{{ route('items.index') }}"
        class="mb-4">

        <div class="row">

            <div class="col-md-5">

                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Meklēt pēc nosaukuma vai apraksta"
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-4">

                <select name="category"
                        class="form-select">

                    <option value="">
                        Visas kategorijas
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <button class="btn btn-primary">
                    Meklēt
                </button>

            </div>

        </div>

    </form>

    @auth
        <a href="{{ route('items.create') }}" class="btn btn-success mb-3">
            Pievienot lietu
        </a>
    @endauth

    @if($items->isEmpty())
        <div class="alert alert-info">
            Nekas netika atrasts.
        </div>
    @else
        @foreach($items as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $item->title }}</h5>

                    <p>{{ $item->description }}</p>

                    <p>
                        <strong>Kategorija:</strong>
                        {{ $item->category->name }}
                    </p>

                    <p>
                        <strong>Veids:</strong>
                        {{ $item->type }}
                    </p>

                    <p>
                        <strong>Statuss:</strong>
                        {{ $item->status }}
                    </p>

                    <a href="{{ route('items.show', $item) }}" class="btn btn-primary">
                        Skatīt
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</x-layout>