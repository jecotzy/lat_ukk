<?php

namespace App\Livewire\Pkl;

use App\Models\Pkl;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ActivityLog;

class Index extends Component
{
    use WithPagination;  // Memakai trait pagination Livewire
    protected $paginationTheme = 'tailwind'; // Gunakan tema Tailwind untuk pagination

    // Properti public yang dapat diakses di view dan update secara reaktif
    public $userMail;    // Menyimpan email user yang login
    public $siswa;       // Menyimpan data siswa yang login
    public $search;      // Kata kunci pencarian industri
    public $deleteId = null; // Menyimpan id PKL yang akan dihapus (dipakai untuk konfirmasi)
    public $numpage = 5; // Jumlah data per halaman (pagination)

    // Method mount dijalankan saat komponen diinisialisasi
    public function mount()
    {
        $this->userMail = Auth::user()->email;                // Ambil email user yang login
    }

    // Reset halaman pagination setiap kali user mengubah kata pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Update jumlah data per halaman (pagination)
    public function updatePageSize($size)
    {
        $this->numpage = $size;
    }

    // Set id data PKL yang ingin dihapus (dipakai untuk konfirmasi modal hapus)
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // Hapus data PKL berdasarkan id
    public function delete($id)
    {
        $pkl = Pkl::findOrFail($id); // Cari data PKL, jika tidak ditemukan akan error 404

        // Simpan informasi PKL dan siswa untuk log aktivitas
        $pklInfo = "PKL ID {$pkl->id} - Siswa ID {$pkl->siswa_id}";

        $pkl->delete(); // Hapus data PKL dari database

        // Simpan log aktivitas penghapusan
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Menghapus Data PKL : $pklInfo",
        ]);

        session()->flash('message', 'Data PKL berhasil dihapus.'); // Flash message sukses
        $this->deleteId = null; // Reset deleteId, biasanya untuk menutup modal konfirmasi

        // Reset pagination ke halaman pertama supaya list data terupdate
        $this->resetPage();
    }

    // Render view dan kirim data PKL yang sudah difilter dan di-pagination
    public function render()
    {
        // Buat query PKL dengan eager loading relasi siswa, industri, dan guru
        $query = Pkl::with(['siswa', 'industri', 'guru']);

        // Jika ada kata kunci pencarian, filter data berdasarkan nama industri yang mirip
        if (!empty($this->search)) {
            $query->whereHas('industri', function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
            });
        }

        // Ambil data dengan pagination sesuai jumlah per halaman
        $pklList = $query->paginate($this->numpage);

        // Kirim data ke view livewire.pkl.index
        return view('livewire.pkl.index', [
            'pklList' => $pklList,
        ]);
    }

}
