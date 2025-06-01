<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri;

class View extends Component
{
    public $industri;

    // cari industri berdasarkan id
    public function mount($id)
    {
        $this->industri = Industri::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.industri.view');
    }

}
