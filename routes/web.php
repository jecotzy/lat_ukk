<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Siswa\Form as SiswaForm;
use App\Livewire\Siswa\View as SiswaView;
use App\Livewire\Guru\Form as GuruForm;
use App\Livewire\Guru\View as GuruView;
use App\Livewire\Industri\Form as IndustriForm;
use App\Livewire\Industri\View as IndustriView;
use App\Livewire\PKL\Form as PKLForm;
use App\Livewire\PKL\View as PKLView;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Http\Controllers\DashboardController;

Route::get('/', fn () => view('welcome'))->name('home');

// Group: Authenticated and Verified users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::redirect('/', 'settings/profile');
        Route::get('profile', Profile::class)->name('profile');
        Route::get('password', Password::class)->name('password');
        Route::get('appearance', Appearance::class)->name('appearance');
    });

    // Tambahan middleware roles
    Route::middleware('check.roles')->group(function () {
        $entities = ['siswa', 'guru', 'industri', 'pkl'];
        foreach ($entities as $entity) {
            Route::view($entity, $entity)->name($entity);
        }
    });

    // Siswa Routes
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('show/{id}', SiswaView::class)->name('show');
        Route::get('create', SiswaForm::class)->name('create');
        Route::get('edit/{id}', SiswaForm::class)->name('edit');
    });

    // Guru Routes
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('show/{id}', GuruView::class)->name('show');
        Route::get('create', GuruForm::class)->name('create');
        Route::get('edit/{id}', GuruForm::class)->name('edit');
    });

    // Industri Routes
    Route::prefix('industri')->name('industri.')->group(function () {
        Route::get('show/{id}', IndustriView::class)->name('show');
        Route::get('create', IndustriForm::class)->name('create');
        Route::get('edit/{id}', IndustriForm::class)->name('edit');
    });

    // PKL Routes
    Route::prefix('pkl')->name('pkl.')->group(function () {
        Route::get('show/{id}', PKLView::class)->name('show');
        Route::get('create', PKLForm::class)->name('create');
        Route::get('edit/{id}', PKLForm::class)->name('edit');
    });
});

require __DIR__ . '/auth.php';
