<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? __('messages.app_name') }}</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('items.index') }}">
            {{ __('messages.app_name') }}
        </a>

        <div class="d-flex gap-2">
            <a href="{{ route('language.switch', 'lv') }}" class="btn btn-outline-light">LV</a>
            <a href="{{ route('language.switch', 'en') }}" class="btn btn-outline-light">EN</a>

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light">
                    {{ __('messages.login') }}
                </a>

                <a href="{{ route('register') }}" class="btn btn-success">
                    {{ __('messages.register') }}
                </a>
            @endguest

            @auth
                <a href="{{ route('items.create') }}" class="btn btn-success">
                    {{ __('messages.create_item') }}
                </a>

                <a href="{{ route('requests.incoming') }}" class="btn btn-outline-light">
                    {{ __('messages.incoming_requests') }}
                </a>

                <a href="{{ route('requests.my') }}" class="btn btn-outline-light">
                    {{ __('messages.my_requests') }}
                </a>

                <a href="{{ route('profile') }}" class="btn btn-outline-light">
                    {{ __('messages.profile') }}
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-warning">
                        {{ __('messages.admin') }}
                    </a>
                @endif

                <span class="navbar-text text-white">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        {{ __('messages.logout') }}
                    </button>
                </form>
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

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{ $slot }}
</main>

</body>
</html>