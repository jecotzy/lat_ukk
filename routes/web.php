<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Siswa\Form as SiswaForm;
use App\Livewire\Siswa\View as SiswaView;
use App\Livewire\Guru\Form as GuruForm;
use App\Livewire\Guru\View as GuruView;
use App\Livewire\Industri\Form as IndustriForm;
use App\Livewire\Industri\View as IndustriView;
use App\Livewire\Pkl\Form as PklForm;
use App\Livewire\Pkl\View as PklView;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Http\Controllers\DashboardController;

Route::get('/', fn () => view('welcome'))->name('home');

// Group: Authenticated and Verified users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('check.roles')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        $entities = ['siswa', 'guru', 'industri', 'pkl'];
        foreach ($entities as $entity) {
            Route::view($entity, $entity)->name($entity);
        }
    });

    // Settings tetap bisa diakses oleh semua yang terverifikasi, tanpa perlu role
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::redirect('/', 'settings/profile');
        Route::get('profile', Profile::class)->name('profile');
        Route::get('password', Password::class)->name('password');
        Route::get('appearance', Appearance::class)->name('appearance');
    });

    // Siswa, Guru, Industri, PKL routes tetap dilindungi sesuai kebutuhan
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('show/{id}', SiswaView::class)->name('show');
        Route::get('create', SiswaForm::class)->name('create');
        Route::get('edit/{id}', SiswaForm::class)->name('edit');
    });

    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('show/{id}', GuruView::class)->name('show');
        Route::get('create', GuruForm::class)->name('create');
        Route::get('edit/{id}', GuruForm::class)->name('edit');
    });

    Route::prefix('industri')->name('industri.')->group(function () {
        Route::get('show/{id}', IndustriView::class)->name('show');
        Route::get('create', IndustriForm::class)->name('create');
        Route::get('edit/{id}', IndustriForm::class)->name('edit');
    });

    Route::prefix('pkl')->name('pkl.')->group(function () {
        Route::get('show/{id}', PklView::class)->name('show');
        Route::get('create', PklForm::class)->name('create');
        Route::get('edit/{id}', PklForm::class)->name('edit');
    });
});


require __DIR__ . '/auth.php';
