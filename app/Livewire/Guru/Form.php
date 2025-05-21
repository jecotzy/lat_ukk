<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    public $id, $nama, $nip, $gender, $alamat, $kontak, $email;

    public function mount($id = null)
    {
        if ($id) {
            $guru = Guru::findOrFail($id);
            $this->id = $guru->id;
            $this->nama = $guru->nama;
            $this->nip = $guru->nip;
            $this->gender = $guru->gender;
            $this->alamat = $guru->alamat;
            $this->kontak = $guru->kontak;
            $this->email = $guru->email;
        }
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:gurus,nip,' . $this->id,
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:gurus,email,' . $this->id,
        ];
    }

    public function messages()
{
    return [
        'nama.required' => 'Nama guru harus diisi.',
        'nama.string' => 'Nama guru harus berupa teks.',
        'nama.max' => 'Nama guru maksimal 255 karakter.',

        'nip.required' => 'NIP harus diisi.',
        'nip.string' => 'NIP harus berupa teks.',
        'nip.max' => 'NIP maksimal 255 karakter.',
        'nip.unique' => 'NIP sudah digunakan.',

        'gender.required' => 'Jenis kelamin harus dipilih.',
        'gender.in' => 'Jenis kelamin harus L atau P.',

        'alamat.required' => 'Alamat harus diisi.',
        'alamat.string' => 'Alamat harus berupa teks.',

        'kontak.required' => 'Kontak harus diisi.',
        'kontak.string' => 'Kontak harus berupa teks.',
        'kontak.max' => 'Kontak maksimal 255 karakter.',

        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email maksimal 255 karakter.',
        'email.unique' => 'Email sudah digunakan.',
    ];
}


    public function save()
    {
        $this->validate();

        $isNew = is_null($this->id);

        $guru = Guru::updateOrCreate(
            ['id' => $this->id],
            [
                'nama' => $this->nama,
                'nip' => $this->nip,
                'gender' => $this->gender,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
            ]
        );

        // Simpan log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => $isNew
                ? 'Menambahkan Guru Baru: ' . $guru->nama
                : 'Memperbarui Data Guru: ' . $guru->nama,
        ]);

        session()->flash('message', 'Data guru berhasil disimpan.');

        return redirect()->route('guru');
    }

    public function render()
    {
        return view('livewire.guru.form');
    }
}
