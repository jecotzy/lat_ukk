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
    use WithPagination;

    public $userMail;
    public $siswa;
    public $search;
    public $deleteId = null;
    public $numpage = 10;

    public function mount()
    {
        $this->userMail = Auth::user()->email;
        $this->siswa = Siswa::where('email', $this->userMail)->first();
    }

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
        $pkl = Pkl::findOrFail($id);

        // Simpan info untuk log
        $pklInfo = "PKL ID {$pkl->id} - Siswa ID {$pkl->siswa_id}";

        $pkl->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Menghapus Data PKL : $pklInfo",
        ]);

        session()->flash('message', 'Data PKL berhasil dihapus.');
        $this->deleteId = null;

        // Reset pagination agar update list
        $this->resetPage();
    }

    public function render()
    {
        if ($this->siswa) {
            $query = Pkl::with(['siswa', 'industri', 'guru'])
                ->where('siswa_id', $this->siswa->id);

            if (!empty($this->search)) {
                $query->whereHas('industri', function($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%');
                });
            }

            $pklList = $query->paginate($this->numpage);
        } else {
            $pklList = Pkl::whereRaw('0 = 1')->paginate($this->numpage);
        }

        return view('livewire.pkl.index', [
            'pklList' => $pklList,
        ]);
    }
}
