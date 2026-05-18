<section>
    <header class="mb-4">
        <h2 class="fs-5 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.05rem;">
            Безопасность и пароль
        </h2>
        <p class="mt-1 text-sm text-muted-gray mb-0" style="font-size: 0.85rem;">
            Убедитесь, что ваш аккаунт использует длинный и случайный пароль для обеспечения максимальной безопасности.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-3 row g-3">
        @csrf
        @method('put')

        <!-- ТЕКУЩИЙ ПАРОЛЬ -->
        <div class="col-12">
            <label for="update_password_current_password" class="form-label text-uppercase small font-monospace fw-bold text-muted-gray mb-1" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                Текущий пароль
            </label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control rounded-0 text-graphite border-subtle-gray @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="text-danger small mt-1 font-monospace" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- НОВЫЙ ПАРОЛЬ -->
        <div class="col-12">
            <label for="update_password_password" class="form-label text-uppercase small font-monospace fw-bold text-muted-gray mb-1" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                Новый пароль
            </label>
            <input id="update_password_password" name="password" type="password" class="form-control rounded-0 text-graphite border-subtle-gray @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="text-danger small mt-1 font-monospace" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- ПОДТВЕРЖДЕНИЕ ПАРОЛЯ -->
        <div class="col-12">
            <label for="update_password_password_confirmation" class="form-label text-uppercase small font-monospace fw-bold text-muted-gray mb-1" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                Подтверждение нового пароля
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control rounded-0 text-graphite border-subtle-gray @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="text-danger small mt-1 font-monospace" style="font-size: 0.75rem;">{{ $message }}</div>
            @enderror
        </div>

        <!-- КНОПКА СОХРАНЕНИЯ -->
        <div class="col-12 d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-accent btn-touch rounded-0 text-uppercase fw-bold px-4 w-100 w-sm-auto" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                Обновить пароль
            </button>

            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success small font-monospace fw-bold">
                    ✓ Пароль изменен.
                </span>
            @endif
        </div>
    </form>
</section>
