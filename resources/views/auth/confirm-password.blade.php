@extends('layouts.shop')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="p-4 bg-light-block border border-subtle-gray">
                <h1 class="fs-5 text-uppercase fw-bold text-graphite mb-3 text-center" style="letter-spacing: 1px;">Подтверждение доступа</h1>
                
                <p class="small text-muted-gray mb-4 text-wrap" style="line-height: 1.5;">
                    Это защищенная зона интернет-магазина. Пожалуйста, введите ваш действующий пароль для подтверждения операции перед продолжением.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger p-2 small mb-3 border-0 rounded-0">
                        <ul class="m-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-4">
                        <label encoding="utf-8" for="password" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Ваш пароль</label>
                        <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password" autofocus>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-flux-dark text-uppercase fw-bold">Подтвердить пароль</button>
                        <a href="{{ route('catalog') }}" class="btn btn-flux-outline text-uppercase fw-bold small" style="font-size: 0.8rem;">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
