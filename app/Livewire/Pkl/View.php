<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Pkl;

class View extends Component
{
    public $pkl;

    public function mount($id)
    {
        // Memuat relasi industri, guru, dan siswa
        $this->pkl = Pkl::with(['siswa', 'industri', 'guru'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pkl.view', [
            'pkl' => $this->pkl,
        ]);
    }
}
