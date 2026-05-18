<section>
    <header class="mb-4">
        <h2 class="fs-5 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.05rem;">
            Профиль пользователя
        </h2>
        <p class="mt-1 text-sm text-muted-gray mb-0" style="font-size: 0.85rem;">
            Обновите регистрационную информацию вашего аккаунта и адрес электронной почты.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-3 row g-3">
        @csrf
        @method('patch')

        <!-- ПОЛЕ: ИМЯ -->
        <div class="col-12">
            <label for="name" class="form-label text-uppercase small font-monospace fw-bold text-muted-gray mb-1" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                Имя пользователя
            </label>
            <input id="name" name="name" type="text" class="form-control rounded-0 text-graphite border-subtle-gray @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger small mt-1 font-monospace" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- ПОЛЕ: EMAIL -->
        <div class="col-12">
            <label for="email" class="form-label text-uppercase small font-monospace fw-bold text-muted-gray mb-1" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                Email адрес
            </label>
            <input id="email" name="email" type="email" class="form-control rounded-0 text-graphite border-subtle-gray @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger small mt-1 font-monospace" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 bg-light p-3 border border-subtle-gray">
                    <p class="text-sm text-graphite mb-2" style="font-size: 0.85rem;">
                        Ваш адрес электронной почты не верифицирован.
                    </p>
                    <button form="send-verification" class="btn btn-outline-dark btn-sm rounded-0 text-uppercase fw-bold font-monospace" style="font-size: 0.65rem; letter-spacing: 0.05rem;">
                        Нажмите здесь, чтобы повторно отправить письмо с подтверждением
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success font-monospace mb-0" style="font-size: 0.75rem;">
                            Новая ссылка для подтверждения была отправлена на ваш email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- КНОПКА СОХРАНЕНИЯ -->
        <div class="col-12 d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-accent btn-touch rounded-0 text-uppercase fw-bold px-4 w-100 w-sm-auto" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                Сохранить изменения
            </button>

            @if (session('status') === 'profile-updated')
                <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success small font-monospace fw-bold">
                    ✓ Изменения сохранены.
                </span>
            @endif
        </div>
    </form>
</section>
