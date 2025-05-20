<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri;
use Livewire\WithPagination;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $numpage = 10;
    public $search;
    public $deleteId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete($id)
    {
        $industri = Industri::findOrFail($id);
        $industriName = $industri->nama;

        $industri->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Menghapus Industri : $industriName",
        ]);

        session()->flash('message', 'Data industri berhasil dihapus.');
        $this->deleteId = null; // Tutup modal hapus

        // Reset halaman ke 1 agar pagination update
        $this->resetPage();
    }

    public function render()
    {
        $query = Industri::query();

        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('alamat', 'like', '%' . $this->search . '%');
        }

        $industriList = $query->paginate($this->numpage);

        return view('livewire.industri.index', [
            'industriList' => $industriList,
        ]);
    }
}
