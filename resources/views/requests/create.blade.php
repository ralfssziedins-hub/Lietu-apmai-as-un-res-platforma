<x-layout>
    <x-slot name="title">Nosūtīt pieprasījumu</x-slot>

    <h1>Nosūtīt pieprasījumu</h1>

    <p><strong>Lieta:</strong> {{ $item->title }}</p>
    <p><strong>Veids:</strong> {{ $item->type }}</p>

    <form method="POST" action="{{ route('requests.store', $item) }}">
        @csrf

        @if($item->type === 'rent')
            <div class="mb-3">
                <label class="form-label">Sākuma datums</label>
                <input type="date" name="start_date" class="form-control"
                       value="{{ old('start_date') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Beigu datums</label>
                <input type="date" name="end_date" class="form-control"
                       value="{{ old('end_date') }}">
            </div>
        @endif

        @if($item->type === 'exchange')
            <div class="mb-3">
                <label class="form-label">Ko piedāvā apmaiņā?</label>
                <select name="offered_item_id" class="form-select">
                    <option value="">Izvēlies savu lietu</option>
                    @foreach($myItems as $myItem)
                        <option value="{{ $myItem->id }}">
                            {{ $myItem->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Ziņa īpašniekam</label>
            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Nosūtīt
        </button>
    </form>
</x-layout>