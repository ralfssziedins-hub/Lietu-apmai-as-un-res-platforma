<x-layout>
    <x-slot name="title">
        Reģistrācija
    </x-slot>

    <h1>Reģistrācija</h1>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{ __('messages.full_name') }}</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.email') }}</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.password') }}</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.password_confirmation') }}</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('messages.register') }}
        </button>
    </form>
</x-layout>