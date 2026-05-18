<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Если юзер авторизован И его роль равна 'admin', то пропускаем дальше
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Если нет — выплевываем ошибку "Доступ запрещен"
        abort(403, 'Доступ в панель управления Fluxcomfort разрешен только администраторам.');
    }
}
