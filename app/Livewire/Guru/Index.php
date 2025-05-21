<?php

namespace App\Livewire\Guru;
use App\Models\Guru;
use Livewire\WithPagination;


use Livewire\Component;

class Index extends Component
{ // Memanggil pagination
    use WithPagination;

    protected $paginationTheme = 'tailwind'; // pastikan tema pagination Tailwind dipakai
    // Deklarasi variabel numpage dan search
    public $numpage = 5;
    public $search;
    public $deleteId = null;


    // Reset halaman setelah search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatePageSize($size)
    {
        $this->numpage = $size;
    }


    public function confirmDelete($id)
{
    $this->deleteId = $id;
}
    // Menghapus data
public function delete($id)
{
    Guru::findOrFail($id)->delete();
    session()->flash('message', 'Data guru berhasil dihapus.');
    $this->deleteId = null; // Tutup modal setelah delete
}


    // Method untuk render keseluruhan
    public function render()
    {
        $query = Guru::query();

        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        $this->guruList = $query->paginate($this->numpage);

        return view('livewire.guru.index', [
            'guruList' => $this->guruList,
        ]);
    }

    
    // Function gender
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
