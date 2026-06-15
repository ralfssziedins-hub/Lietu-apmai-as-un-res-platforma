<x-layout>
    <x-slot name="title">
        Sākums
    </x-slot>

    <h1>Lietu apmaiņas un īres platforma</h1>

    <p>
        Šeit lietotāji varēs piedāvāt lietas īrei vai apmaiņai.
    </p>

    @guest
        <p>
            Lai pievienotu savas lietas vai nosūtītu pieprasījumus,
            lūdzu pieslēdzies vai reģistrējies.
        </p>
    @endguest

    @auth
        <p>
            Tu esi pieslēdzies kā {{ auth()->user()->name }}.
        </p>
    @endauth
</x-layout>