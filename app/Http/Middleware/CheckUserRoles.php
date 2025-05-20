<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRoles
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki salah satu role yang dibutuhkan
        if (!auth()->check() || !auth()->user()->hasAnyRole(['Super_Admin', 'Siswa', 'Guru'])) {
            // Jika tidak, kembalikan 403 Forbidden
            abort(403, 'Anda belum punya akses. Silakan hubungi admin :)');
        }

        return $next($request);
    }

}
