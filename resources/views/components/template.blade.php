<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name'))</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
    {{ View::make('components.navbar') }}
    <div class="container">
        @yield('content')
    </div>

    <div class="modal" id="signInModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Sign In</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Select your favorite provider to join this wonderful application</p>
                    <div class="d-grid gap-2">
                        @foreach (Config::get('providers') as $provider) 
                            @if (!$provider['enabled'])
                                @continue
                            @endif

                            <a href="{{ $provider['base_uri'] }}/authorize?client_id={{ $provider['client_id'] }}&redirect_uri={{ $provider['redirect_uri'] }}&scope={{ $provider['scope'] }}&response_type=code" class="btn btn-purple"><i class="fab fa-{{ strtolower($provider['name']) }}"></i> Sign in with {{ $provider['name'] }} </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/boostrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @yield('scripts')
    </body>
</html>
