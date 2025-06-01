<?php

namespace App\Livewire\Industri;

use App\Models\Industri;
use Livewire\Component;

class Form extends Component
{
    // Deklarasi properti untuk menampung data input form
    public $id, $nama, $bidang_usaha, $alamat, $kontak, $email, $website;

    public function mount($id = null)
    {
        if ($id) {
            $industri = Industri::findOrFail($id); // Cari data berdasarkan id
            $this->id = $industri->id;
            $this->nama = $industri->nama;
            $this->bidang_usaha = $industri->bidang_usaha;
            $this->alamat = $industri->alamat;
            $this->kontak = $industri->kontak;
            $this->email = $industri->email;
            $this->website = $industri->website;
        }
    }

    // Aturan validasi data input sebelum disimpan
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',            // Nama wajib diisi, tipe string maksimal 255 karakter
            'bidang_usaha' => 'required|string|max:255',    // Bidang usaha wajib diisi, tipe string maksimal 255 karakter
            'alamat' => 'required|string',                   // Alamat wajib diisi, tipe string
            'kontak' => 'required|string|max:255',           // Kontak wajib diisi, tipe string maksimal 255 karakter
            'email' => 'required|email|max:255',             // Email wajib diisi, format email valid, maksimal 255 karakter
            'website' => 'nullable|string|max:255',          // Website tidak wajib, jika diisi harus string maksimal 255 karakter
        ];
    }

    // Pesan kustom untuk validasi yang gagal
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

    // Method untuk menyimpan data ke database
    public function save()
    {
        $this->validate(); // Validasi data sesuai rules

        // Simpan data industri baru atau update jika sudah ada id
        Industri::updateOrCreate(
            ['id' => $this->id], // Kondisi pencarian (update jika id ada)
            [
                'nama' => $this->nama,
                'bidang_usaha' => $this->bidang_usaha,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
                'website' => $this->website,
            ]
        );

        // Tampilkan pesan sukses di session
        session()->flash('message', 'Data industri berhasil disimpan.');

        // Redirect ke halaman daftar industri
        return redirect()->route('industri');
    }

    // Method render menampilkan view form
    public function render()
    {
        return view('livewire.industri.form');
    }
}
