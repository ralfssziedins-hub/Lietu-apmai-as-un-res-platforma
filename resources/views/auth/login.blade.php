<x-layout>
    <x-slot name="title">
        Pieslēgšanās
    </x-slot>

    <h1>Pieslēgšanās</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">E-pasts</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Parole</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Pieslēgties
        </button>
    </form>
</x-layout>