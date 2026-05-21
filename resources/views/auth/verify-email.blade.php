@extends('layouts.shop')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-5">
            <div class="p-4 bg-light-block border border-subtle-gray">
                <h1 class="fs-4 text-uppercase fw-bold text-graphite mb-3 text-center" style="letter-spacing: 1px;">Подтверждение почты</h1>
                
                <p class="small text-muted-gray mb-4 text-wrap" style="line-height: 1.5;">
                    Спасибо за регистрацию на платформе Fluxcomfort! Перед тем как приступить к покупкам, пожалуйста, подтвердите свой Email адрес, перейдя по безопасной ссылке, которую мы только что отправили вам. Если письмо не пришло, мы вышлем его повторно.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success p-2 small mb-4 border-0 text-accent bg-white fw-bold font-monospace">
                        Новая ссылка для верификации успешно сгенерирована и отправлена на указанный при регистрации Email адрес.
                    </div>
                @endif

                <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch align-items-sm-center justify-content-between pt-3 border-top border-subtle-gray">
                    <form method="POST" action="{{ route('verification.send') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-flux-primary btn-sm text-uppercase fw-bold px-3 py-2">Выслать ссылку повторно</button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-flux-outline btn-sm text-uppercase fw-bold px-3 py-2 font-monospace w-100" style="font-size:0.75rem;">Выйти из профиля</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
