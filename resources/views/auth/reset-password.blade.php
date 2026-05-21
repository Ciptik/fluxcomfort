@extends('layouts.shop')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="p-4 bg-light-block border border-subtle-gray">
                <h1 class="fs-4 text-uppercase fw-bold text-graphite mb-4 text-center" style="letter-spacing: 1px;">Обновление пароля</h1>

                @if ($errors->any())
                    <div class="alert alert-danger p-2 small mb-3 border-0 rounded-0">
                        <ul class="m-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label for="email" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Email адрес</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Новый пароль</label>
                        <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password" autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Повторите новый пароль</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-flux-dark text-uppercase fw-bold">Установить новый пароль</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
