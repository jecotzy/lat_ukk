<?php

namespace App\Livewire\Industri;

use App\Models\Industri;
use Livewire\Component;

class Form extends Component
{

    public $id, $nama, $bidang_usaha, $alamat, $kontak, $email, $website;

    public function mount($id = null)
    {
        if ($id) {
            $industri = Industri::findOrFail($id);
            $this->id = $industri->id;
            $this->nama = $industri->nama;
            $this->bidang_usaha = $industri->bidang_usaha;
            $this->alamat = $industri->alamat;
            $this->kontak = $industri->kontak;
            $this->email = $industri->email;
            $this->website = $industri->website;
        }
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();

        // Jika ingin simpan gambar, aktifkan ini dan tambahkan kolom di DB
        // $imagePath = $this->foto ? $this->foto->store('foto_industri', 'public') : null;

        Industri::updateOrCreate(
            ['id' => $this->id],
            [
                'nama' => $this->nama,
                'bidang_usaha' => $this->bidang_usaha,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
                'website' => $this->website,
            ]
        );

        session()->flash('message', 'Data industri berhasil disimpan.');

        return redirect()->route('industri');
    }

    public function render()
    {
        return view('livewire.industri.form');
    }
}
