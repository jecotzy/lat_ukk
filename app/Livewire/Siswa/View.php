<?php

namespace App\Livewire\Siswa;

// Mengimpor komponen Livewire dan model Siswa
use Livewire\Component;
use App\Models\Siswa;

class View extends Component
{
    // Properti publik untuk menyimpan data siswa yang akan ditampilkan
    public $siswa;

    // Fungsi mount dijalankan saat komponen pertama kali dipanggil
    public function mount($id)
    {
        // Cari data siswa berdasarkan ID, jika tidak ditemukan akan menampilkan error 404
        $this->siswa = Siswa::findOrFail($id);
    }

    // Fungsi untuk menampilkan keterangan status PKL
    public function ketStatusPKL($status)
    {
        if ($status === 'no') {
            return 'Belum diterima PKL'; // Jika status 'no'
        } elseif ($status === 'yes') {
            return 'Sudah diterima PKL'; // Jika status 'yes'
        } else {
            return 'Status tidak diketahui'; // Jika nilai status tidak dikenal
        }
    }

    // Fungsi untuk menampilkan keterangan jenis kelamin
    public function ketGender($gender)
    {
        if ($gender === 'L') {
            return 'Laki-laki'; // Jika gender 'L'
        } elseif ($gender === 'P') {
            return 'Perempuan'; // Jika gender 'P'
        } else {
            return 'Status tidak diketahui'; // Jika nilai gender tidak dikenal
        }
    }

    // Fungsi untuk me-render tampilan view dari komponen ini
    public function render()
    {
        return view('livewire.siswa.view'); // Mengarahkan ke file Blade: resources/views/livewire/siswa/view.blade.php
    }
}
