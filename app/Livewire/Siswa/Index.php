<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    // Mengaktifkan fitur pagination dari Livewire
    use WithPagination;

    // Mengatur tema pagination agar cocok dengan Tailwind CSS
    protected $paginationTheme = 'tailwind';

    // Jumlah item per halaman
    public $numpage = 5;

    // Kata kunci pencarian
    public $search;

    // ID siswa yang akan dihapus
    public $deleteId = null;

    // Menyimpan query string di URL agar state tetap saat refresh
    protected $queryString = [
        'numpage' => ['except' => 5], // jangan tampilkan jika default
        'search' => ['except' => ''], // jangan tampilkan jika kosong
    ];

    // Mereset halaman ke awal setiap kali search diperbarui
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Mengubah jumlah data per halaman
    public function updatePageSize($size)
    {
        $this->numpage = $size;
    }

    // Menyimpan ID untuk konfirmasi sebelum menghapus
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // Menghapus data siswa berdasarkan ID
    public function delete($id)
    {
        Siswa::findOrFail($id)->delete(); // Hapus data siswa
        session()->flash('message', 'Data siswa berhasil dihapus.'); // Tampilkan notifikasi
        $this->deleteId = null; // Reset ID setelah dihapus
    }

    // Fungsi utama untuk merender halaman dan menampilkan data siswa
    public function render()
    {
        // Ambil query dasar dari model Siswa
        $query = Siswa::query();

        // Jika ada kata kunci pencarian
        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nis', 'like', '%' . $this->search . '%');
        }

        // Ambil hasil dengan pagination
        $this->siswaList = $query->paginate($this->numpage);

        // Tampilkan view dengan data siswaList
        return view('livewire.siswa.index', [
            'siswaList' => $this->siswaList,
        ]);
    }

    // Fungsi bantu untuk menampilkan teks gender
    public function ketGender($gender)
    {
        if ($gender === 'L') {
            return 'Laki-laki';
        } elseif ($gender === 'P') {
            return 'Perempuan';
        } else {
            return 'Status tidak diketahui';
        }
    }

    // Fungsi bantu untuk menampilkan status PKL
    public function ketStatusPKL($status)
    {
        if ($status === 'no') {
            return 'Belum Lapor';
        } elseif ($status === 'yes') {
            return 'Sudah Lapor';
        } else {
            return 'Status tidak diketahui';
        }
    }
}
