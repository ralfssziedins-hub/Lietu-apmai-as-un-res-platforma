<x-layout>
    <x-slot name="title">
        Pieslēgšanās
    </x-slot>

    <h1>{{ __('messages.login_title') }}</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

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

        <button type="submit" class="btn btn-primary">
            {{ __('messages.login') }}
        </button>
    </form>
</x-layout>