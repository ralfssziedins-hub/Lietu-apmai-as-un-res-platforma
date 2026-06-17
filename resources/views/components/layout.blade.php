<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lietu apmaiņa un īre' }}</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('items.index') }}">
        Lietu apmaiņa un īre
        </a>

        <div class="d-flex gap-2">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light">
                    Pieslēgties
                </a>

                <a href="{{ route('register') }}" class="btn btn-success">
                    Reģistrēties
                </a>
            @endguest

    @auth

        <a href="{{ route('items.create') }}" class="btn btn-success">
            Pievienot lietu
        </a>

        <span class="navbar-text text-white">
            {{ auth()->user()->name }}
            @if(auth()->user()->isAdmin())
                (Admin)
            @else
                (Lietotājs)
            @endif
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                Iziet
            </button>
        </form>

        <a href="{{ route('requests.incoming') }}" class="btn btn-outline-light">
            Pieprasījumi
        </a>

        <a href="{{ route('requests.my') }}" class="btn btn-outline-light">
            Mani pieprasījumi
        </a>

        <a href="{{ route('profile') }}" class="btn btn-outline-light">
            Mans profils
        </a>
    @endauth
        </div>
    </div>
</nav>

<main class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.index') }}" class="btn btn-outline-warning">
                Admin panelis
            </a>
        @endif
    @endauth

    {{ $slot }}
</main>

</body>
</html>