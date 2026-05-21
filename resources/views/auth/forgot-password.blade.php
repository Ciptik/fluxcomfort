@extends('layouts.shop')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="p-4 bg-light-block border border-subtle-gray">
                <h1 class="fs-5 text-uppercase fw-bold text-graphite mb-3 text-center" style="letter-spacing: 1px;">Восстановление</h1>
                
                <p class="small text-muted-gray mb-3 text-wrap" style="line-height: 1.5;">
                    Забыли пароль? Укажите Email адрес вашей учетной записи, и мы вышлем вам прямую ссылку для генерации нового надежного пароля.
                </p>

                @if (session('status'))
                    <div class="alert alert-success p-2 small mb-3 border-0 text-accent bg-white fw-bold font-monospace">
                        {{ session('status') == 'We have emailed your password reset link.' ? 'Ссылка для сброса успешно отправлена на вашу почту.' : session('status') }}
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

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label small text-uppercase font-monospace text-muted-gray mb-1">Email адрес</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-flux-primary text-uppercase fw-bold">Получить ссылку</button>
                    </div>
                    
                    <div class="text-center mt-3 pt-2 border-top border-subtle-gray">
                        <a href="{{ route('login') }}" class="small text-muted-gray text-decoration-none border-bottom font-monospace text-lowercase">← вернуться ко входу</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
