<?php

// Namespace untuk controller API
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\RegisterRequest; // Form request khusus untuk validasi register
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Models\Guru;

class AuthController extends Controller
{
    // Fungsi login pengguna
    public function login(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba autentikasi kredensial
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login gagal, email atau password salah.'], 401);
        }

        // Ambil user yang berhasil login
        $user = Auth::user();

        // Cek apakah user memiliki role yang diperbolehkan
        if ($user->hasRole('Siswa')) {
            // Validasi bahwa email terdaftar di tabel siswa
            $siswa = Siswa::where('email', $credentials['email'])->first();
            if (!$siswa) {
                Auth::logout();
                return response()->json([
                    'message' => 'Email Anda belum terdaftar sebagai siswa. Silakan hubungi admin.'
                ], 403);
            }
        } elseif ($user->hasRole('Guru')) {
            // Validasi bahwa email terdaftar di tabel guru
            $guru = Guru::where('email', $credentials['email'])->first();
            if (!$guru) {
                Auth::logout();
                return response()->json([
                    'message' => 'Email Anda belum terdaftar sebagai guru. Silakan hubungi admin.'
                ], 403);
            }
        } else {
            // Jika bukan siswa atau guru
            Auth::logout();
            return response()->json([
                'message' => 'Anda tidak memiliki akses login.'
            ], 403);
        }

        // Buat token baru
        $token = $user->createToken('api-token')->plainTextToken;

        // Kirim response
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }


    // Fungsi register pengguna baru
    public function register(RegisterRequest $request)
        {
            // Buat pengguna baru
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => Carbon::now(),
            ]);

            // Cek apakah email ada di tabel siswa
            $siswa = Siswa::where('email', $request->email)->first();

            // Cek apakah email ada di tabel guru
            $guru = Guru::where('email', $request->email)->first();

            // Tentukan role berdasarkan data yang ditemukan
            if ($siswa) {
                $newUser->assignRole('Siswa');
            } elseif ($guru) {
                $newUser->assignRole('Guru');
            } else {
                // Jika tidak ditemukan di siswa maupun guru, hapus user dan tolak
                $newUser->delete();

                return response()->json([
                    'message' => 'Email Anda belum terdaftar sebagai siswa atau guru. Silakan hubungi admin.'
                ], 403);
            }

            // Login otomatis
            Auth::login($newUser);

            // Buat token
            $token = $newUser->createToken('api-token')->plainTextToken;

            return response()->json([
                'user' => $newUser,
                'token' => $token,
                'message' => 'Register berhasil sebagai ' . ($siswa ? 'Siswa' : 'Guru')
            ]);
        }


    // Fungsi logout user dari API
    public function logout(Request $request)
    {
        // Hapus token akses user yang sedang login
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        // Kembalikan response logout berhasil (204 = No Content)
        return response()->json([
            'message' => 'Logout Berhasil'
        ], 204);
    }
}
