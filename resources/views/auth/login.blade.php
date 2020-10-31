<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('img/icone.png')}}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hipe - Login</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome-5.15.1/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body class="d-flex align-items-center">
    <div class="wrapper container d-flex justify-content-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <img class="image"
                             src="{{asset('img/logo.png')}}"
                             alt="logo"
                        >
                    </div>

                    <div class="card-body col-lg-8 col-md-10 col-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">
                                            <i class="fas fa-user icon-input d-flex align-items-center"></i>
                                        </span>
                                    </div>

                                    <input id="email"
                                           type="email"
                                           placeholder="E-mail"
                                           class="form-control"
                                           name="email" value="{{ old('email') }}"
                                           required
                                           autocomplete="email"
                                           autofocus
                                    >
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">
                                        <i class="fas fa-key icon-input d-flex align-items-center"></i>
                                    </span>
                                    </div>

                                    <input id="password"
                                           type="password"
                                           placeholder="Senha"
                                           class="form-control"
                                           name="password" value="{{ old('password') }}"
                                           required
                                           autocomplete="current-password"
                                    >
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Lembrar-me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row mb-0 justify-content-center" style="margin-top: 20px;">
                                <div class="col-md-8">
                                    <button type="submit" class="btn">
                                        {{ __('ENTRAR') }}
                                    </button>
                                </div>

                                <div class="col-md-8 text-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn-link" href="{{ route('password.request') }}">
                                            {{ __('Esqueceu sua senha?') }}
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

