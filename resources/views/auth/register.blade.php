@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-6 col-lg-4">
        <div class="p-4 bg-light-block border border-subtle-gray shadow-sm">
            <h1 class="fs-5 text-uppercase fw-bold text-graphite mb-4 text-center" style="letter-spacing: 1px;">Регистрация</h1>

            @if ($errors->any())
                <div class="alert alert-danger p-2 small mb-3 border-0 rounded-0">
                    <ul class="m-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Ваше имя / Компания</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Email адрес</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Новый пароль</label>
                    <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Повторите пароль</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-flux-primary text-uppercase fw-bold">Создать аккаунт</button>
                </div>

                <div class="text-center mt-3 pt-2 border-top border-subtle-gray">
                    <span class="small text-muted-gray">Уже зарегистрированы? </span>
                    <a href="{{ route('login') }}" class="small text-graphite fw-bold text-decoration-none border-bottom text-uppercase font-monospace" style="font-size: 0.8rem;">Войти</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
