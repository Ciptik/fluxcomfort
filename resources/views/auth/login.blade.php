@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-6 col-lg-4">
        <div class="p-4 bg-light-block border border-subtle-gray shadow-sm">
            <h1 class="fs-5 text-uppercase fw-bold text-graphite mb-4 text-center" style="letter-spacing: 1px;">Вход в кабинет</h1>

            @if (session('status'))
                <div class="alert alert-success p-2 small mb-3 border-0 text-accent bg-white fw-bold">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger p-2 small mb-3 border-0 rounded-0">
                    <ul class="m-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Электронная почта</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label small text-uppercase font-monospace text-muted-gray m-0">Пароль</label>
                        @if (Route::has('password.request'))
                            <a class="font-monospace text-lowercase text-muted-gray small text-decoration-none border-bottom" href="{{ route('password.request') }}">забыли?</a>
                        @endif
                    </div>
                    <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
                </div>

                <div class="form-check mb-4">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <label for="remember_me" class="form-check-label small text-uppercase font-monospace text-graphite">Запомнить устройство</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-flux-dark text-uppercase fw-bold">Войти в систему</button>
                </div>
                
                <div class="text-center mt-3 pt-2 border-top border-subtle-gray">
                    <span class="small text-muted-gray">Нет аккаунта? </span>
                    <a href="{{ route('register') }}" class="small text-graphite fw-bold text-decoration-none border-bottom text-uppercase font-monospace" style="font-size: 0.8rem;">Регистрация</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
