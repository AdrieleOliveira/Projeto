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

                    <div class="form-group row">
                        @if (session('success'))
                            <div class="col-sm-12">
                                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        @if (session('error'))
                            <div class="col-sm-12">
                                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-body col-lg-8 col-md-10 col-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">
                                            <i class="fas fa-at icon-input d-flex align-items-center"></i>
                                        </span>
                                    </div>

                                    <input id="email-login"
                                           type="email"
                                           placeholder="E-mail"
                                           class="form-control"
                                           name="email-login" value="{{ old('email-login') }}"
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

                                    <input id="password-login"
                                           type="password"
                                           placeholder="Senha"
                                           class="form-control"
                                           name="password-login" value="{{ old('password-login') }}"
                                           required
                                           autocomplete="current-password"
                                    >
                                </div>
                            </div>

                            <div class="form-group row mb-0 justify-content-center" style="margin-top: 20px;">
                                <div class="col-md-8">
                                    <button type="submit" class="btn">
                                        ENTRAR
                                    </button>
                                </div>

                                <div class="col-md-8 text-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn-link" href="{{ route('password.request') }}">
                                            Esqueceu sua senha?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <a class="btn-link" id="register" href="#">
                                    Crie uma nova conta
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="modalRegister">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cadastre-se</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">
                                            <i class="fas fa-user icon-input d-flex align-items-center"></i>
                                        </span>
                                        </div>

                                        <input id="name"
                                               type="name"
                                               placeholder="Nome"
                                               class="form-control"
                                               name="name" value="{{ old('name') }}"
                                               required
                                               autocomplete="name"
                                               autofocus
                                        >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">
                                            <i class="fas fa-at icon-input d-flex align-items-center"></i>
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
                                               name="password"
                                               required
                                               autocomplete="new-password"
                                        >
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success save">Salvar</button>
                                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

<script src="{{asset('js/login.js')}}" defer></script>

