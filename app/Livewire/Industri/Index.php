<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri;
use Livewire\WithPagination;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    // Menggunakan trait WithPagination untuk fitur pagination di Livewire
    use WithPagination;

    // Mengatur tema pagination menggunakan Tailwind CSS
    protected $paginationTheme = 'tailwind';

    // Jumlah item per halaman, default 5
    public $numpage = 5;

    // Variabel untuk menyimpan input pencarian (search)
    public $search;

    // Variabel untuk menyimpan ID yang akan dihapus (untuk konfirmasi hapus)
    public $deleteId = null;

    // Reset halaman pagination ketika input search berubah (biar halaman kembali ke 1)
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Mengubah jumlah item per halaman berdasarkan input user
    public function updatePageSize($size)
    {
        $this->numpage = $size;
    }

    // Simpan ID data yang akan dikonfirmasi untuk dihapus (misal tampilkan modal hapus)
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // Menghapus data industri berdasarkan ID
    public function delete($id)
    {
        // Cari data industri, jika tidak ditemukan error 404
        $industri = Industri::findOrFail($id);

        // Simpan nama industri untuk log aktivitas
        $industriName = $industri->nama;

        // Hapus data industri
        $industri->delete();

        // Simpan aktivitas penghapusan ke log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'description' => "Menghapus Industri : $industriName",
        ]);

        // Tampilkan pesan sukses di session
        session()->flash('message', 'Data industri berhasil dihapus.');

        // Reset deleteId untuk menutup modal konfirmasi hapus
        $this->deleteId = null;

        // Reset halaman pagination ke 1 agar data yang ditampilkan update
        $this->resetPage();
    }

    // Method render untuk menampilkan data industri dengan pagination dan search
    public function render()
    {
        // Inisialisasi query builder dari model Industri
        $query = Industri::query();

        // Jika ada input pencarian, filter data berdasarkan nama atau alamat
        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('alamat', 'like', '%' . $this->search . '%');
        }

        // Ambil data dengan pagination sesuai jumlah item per halaman ($numpage)
        $industriList = $query->paginate($this->numpage);

        // Kirim data industri ke view livewire.industri.index
        return view('livewire.industri.index', [
            'industriList' => $industriList,
        ]);
    }
}
