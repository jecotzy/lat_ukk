<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // Validasi input
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Cek apakah email siswa sudah terdaftar
        $siswa = Siswa::where('email', $validated['email'])->first();

        // Cek apakah email siswa sudah terdaftar
        $guru = Guru::where('email', $validated['email'])->first();

        // Siapkan array error jika tidak ditemukan
        $errors = [];

        if (!$siswa) {
            $errors[] = 'Email Anda belum terdaftar sebagai siswa.';
        }

        if (!$guru) {
            $errors[] = 'Email Anda belum terdaftar sebagai guru.';
        }

        // Jika tidak ditemukan di keduanya, return error gabungan
        if (count($errors) === 2) {
            throw ValidationException::withMessages([
                'email' => $errors,
            ]);
        }

        // Tentukan rolenya
        $role = $siswa ? 'Siswa' : 'Guru';

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Buat user baru
        $user = User::create($validated);

        // Assign role dinamis (siswa atau guru)
        $user->assignRole($role);

        // Event pendaftaran & login
        event(new Registered($user));
        Auth::login($user);

        // Redirect ke dashboard
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
