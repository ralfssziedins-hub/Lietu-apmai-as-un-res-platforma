<x-layout>

    <x-slot name="title">
        {{ __('messages.home') }}
    </x-slot>

    <h1>{{ __('messages.home_title') }}</h1>

    <p>
        {{ __('messages.home_description') }}
    </p>

    @guest

        <p>
            {{ __('messages.home_guest_text') }}
        </p>

    @endguest

    @auth

        <p>
            {{ __('messages.logged_in_as') }}
            {{ auth()->user()->name }}
        </p>

    @endauth

</x-layout>