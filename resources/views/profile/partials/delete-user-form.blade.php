<section>
    <header class="mb-4">
        <h2 class="fs-5 text-uppercase fw-bold text-danger m-0" style="letter-spacing: 0.05rem;">
            Удаление аккаунта
        </h2>
        <p class="mt-1 text-sm text-muted-gray mb-0" style="font-size: 0.85rem;">
            Как только ваш аккаунт будет удален, все его ресурсы и данные будут стерты безвозвратно. Перед удалением, пожалуйста, сохраните любые важные данные или информацию.
        </p>
    </header>

    <!-- КНОПКА ВЫЗОВА МОДАЛЬНОГО ОКНА БЕЗ СКРУГЛЕНИЙ -->
    <button type="button" class="btn btn-outline-danger btn-touch rounded-0 text-uppercase fw-bold px-4 w-100 w-sm-auto" style="font-size: 0.75rem; letter-spacing: 0.05rem;" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        Удалить личный кабинет
    </button>

    <!-- ЧИСТЫЙ MODAL НА BOOTSTRAP 5 -->
    <div class="modal fade" id="confirmUserDeletionModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 border border-subtle-gray bg-white p-2">
                
                <form method="post" action="{{ route('profile.destroy') }}" class="modal-body p-4">
                    @csrf
                    @method('delete')

                    <h2 class="fs-5 text-uppercase fw-bold text-graphite mb-2" id="confirmUserDeletionModalLabel" style="letter-spacing: 0.05rem;">
                        Вы уверены, что хотите удалить аккаунт?
                    </h2>

                    <p class="text-muted-gray mb-4" style="font-size: 0.85rem; line-height: 1.4;">
                        После подтверждения все ваши персональные данные и история заказов будут полностью уничтожены. Пожалуйста, введите ваш пароль, чтобы подтвердить серьезность намерений.
                    </p>

                    <!-- ПОЛЕ ПАРОЛЯ ДЛЯ ПОДТВЕРЖДЕНИЯ -->
                    <div class="mb-4">
                        <label for="password" class="form-label text-uppercase small font-monospace fw-bold text-muted-gray mb-1" style="font-size: 0.65rem; letter-spacing: 0.05rem;">Введите ваш текущий пароль</label>
                        <input id="password" name="password" type="password" class="form-control rounded-0 border-subtle-gray text-graphite @error('password', 'userDeletion') is-invalid @enderror" placeholder="Пароль доступа" required>
                        @error('password', 'userDeletion')
                            <div class="text-danger small mt-1 font-monospace" style="font-size: 0.75rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ПАНЕЛЬ КНОПОК УПРАВЛЕНИЯ МОДАЛКОЙ -->
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 pt-2 border-top border-subtle-gray">
                        <button type="button" class="btn btn-outline-dark btn-touch rounded-0 text-uppercase fw-bold font-monospace w-100 w-sm-auto" style="font-size: 0.7rem; letter-spacing: 0.05rem;" data-bs-dismiss="modal">
                            Отмена
                        </button>
                        <button type="submit" class="btn btn-danger btn-touch rounded-0 text-uppercase fw-bold font-monospace w-100 w-sm-auto" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                            Удалить безвозвратно
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<!-- ПОДКЛЮЧЕНИЕ СКРИПТА BOOTSTRAP ДЛЯ ОТКРЫТИЯ МОДАЛКИ (ЕСЛИ ЕЩЕ НЕ ПОДКЛЮЧЕН В ПАКЕТЕ) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

<!-- Скрипт автоматического открытия модального окна в случае ошибок валидации -->
@if($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
        myModal.show();
    });
</script>
@endif
