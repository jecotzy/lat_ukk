<?php

namespace App\Livewire\Guru;

use App\Models\Guru;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    // Menggunakan fitur pagination dari Livewire
    use WithPagination;

    // Menentukan tema pagination yang digunakan (Tailwind CSS)
    protected $paginationTheme = 'tailwind';

    // Variabel publik yang dapat digunakan di view
    public $numpage = 5; // Jumlah data per halaman
    public $search; // Kata kunci pencarian
    public $deleteId = null; // ID guru yang akan dihapus (untuk konfirmasi)

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatePageSize($size)
    {
        $this->numpage = $size;
        $this->resetPage();
    }


    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete($id)
    {
        Guru::findOrFail($id)->delete(); // Hapus data
        session()->flash('message', 'Data guru berhasil dihapus.');
        $this->deleteId = null; // Tutup modal konfirmasi
        $this->resetPage();
    }

    public function render()
    {
        $query = Guru::query(); // Inisialisasi query builder

        // Jika ada kata pencarian, filter berdasarkan nama, NIP, atau email
        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        // Paginate hasil pencarian atau seluruh data
        $guruList = $query->paginate($this->numpage);

        // Kirim data ke view 'livewire.guru.index'
        return view('livewire.guru.index', [
            'guruList' => $guruList,
        ]);
    }

    /**
     * Fungsi untuk mengubah kode gender menjadi label teks.
     */
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
}
