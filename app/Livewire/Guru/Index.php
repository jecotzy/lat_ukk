<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;
use Livewire\WithPagination;
use App\Models\ActivityLog;       // import model ActivityLog
use Illuminate\Support\Facades\Auth;  // import Auth

class Index extends Component
{
    use WithPagination;

    public $search;
    public $deleteId = null;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // Hapus data guru dengan log aktivitas
    public function delete($id)
    {
        $guru = Guru::findOrFail($id);

        // Simpan nama guru sebelum dihapus, untuk log
        $guruName = $guru->nama;

        $guru->delete();

        // Buat log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Menghapus Data Guru : $guruName",
        ]);

        session()->flash('message', 'Data guru berhasil dihapus.');
        $this->deleteId = null; // Tutup modal
    }

    public function render()
    {
        $guruList = Guru::when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nip', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy('nama')
        ->paginate(10);

        return view('livewire.guru.index', [
            'guruList' => $guruList,
        ]);
    }

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
