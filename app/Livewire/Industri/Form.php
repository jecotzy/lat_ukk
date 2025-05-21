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

    public function messages()
{
    return [
        'nama.required' => 'Nama industri harus diisi.',
        'nama.string' => 'Nama industri harus berupa teks.',
        'nama.max' => 'Nama industri maksimal 255 karakter.',

        'bidang_usaha.required' => 'Bidang usaha harus diisi.',
        'bidang_usaha.string' => 'Bidang usaha harus berupa teks.',
        'bidang_usaha.max' => 'Bidang usaha maksimal 255 karakter.',

        'alamat.required' => 'Alamat harus diisi.',
        'alamat.string' => 'Alamat harus berupa teks.',

        'kontak.required' => 'Kontak harus diisi.',
        'kontak.string' => 'Kontak harus berupa teks.',
        'kontak.max' => 'Kontak maksimal 255 karakter.',

        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email maksimal 255 karakter.',

        'website.string' => 'Website harus berupa teks.',
        'website.max' => 'Website maksimal 255 karakter.',
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
