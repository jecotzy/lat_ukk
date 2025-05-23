<?php

namespace App\Livewire\Siswa;
use App\Models\Siswa;
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

    protected $queryString = [
        'numpage' => ['except' => 5],
        'search' => ['except' => ''],
    ];

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
    Siswa::findOrFail($id)->delete();
    session()->flash('message', 'Data siswa berhasil dihapus.');
    $this->deleteId = null; // Tutup modal setelah delete
}


    // Method untuk render keseluruhan
    public function render()
    {
        $query = Siswa::query();

        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('nis', 'like', '%' . $this->search . '%');
        }

        $this->siswaList = $query->paginate($this->numpage);

        return view('livewire.siswa.index', [
            'siswaList' => $this->siswaList,
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

    // Function Status PKL
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
