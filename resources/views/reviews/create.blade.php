<x-layout>

    <x-slot name="title">
        {{ __('messages.review') }}
    </x-slot>

    <h1>{{ __('messages.leave_review') }}</h1>

    <form method="POST"
          action="{{ route('reviews.store', $requestModel) }}">

        @csrf

        <div class="mb-3">

            <label class="form-label">
                {{ __('messages.rating') }}
            </label>

            <select name="rating" class="form-select">

                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                {{ __('messages.review') }}
            </label>

            <textarea name="text"
                      class="form-control"
                      rows="5"></textarea>

        </div>

        <button class="btn btn-primary">
            {{ __('messages.save') }}
        </button>

    </form>

</x-layout>