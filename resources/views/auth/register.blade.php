<x-layout>
    <x-slot name="title">
        Reģistrācija
    </x-slot>

    <h1>Reģistrācija</h1>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Vārds</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name') }}"
                   required>
        </div>

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

        <div class="mb-3">
            <label class="form-label">Atkārtot paroli</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Reģistrēties
        </button>
    </form>
</x-layout>