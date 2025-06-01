<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    // Variabel publik yang mewakili field input form guru
    public $id, $nama, $nip, $gender, $alamat, $kontak, $email;

    // Method mount dipanggil saat komponen diinisialisasi,
    // Jika ada $id, berarti edit data dan isi variabel dengan data guru yang ada di DB
    public function mount($id = null)
    {
        if ($id) {
            // Cari data guru berdasarkan id, jika tidak ditemukan akan error 404
            $guru = Guru::findOrFail($id);
            // Isi variabel dengan data guru untuk ditampilkan di form
            $this->id = $guru->id;
            $this->nama = $guru->nama;
            $this->nip = $guru->nip;
            $this->gender = $guru->gender;
            $this->alamat = $guru->alamat;
            $this->kontak = $guru->kontak;
            $this->email = $guru->email;
        }
    }

    // Aturan validasi form input
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255', // Nama wajib diisi, berupa teks max 255 karakter
            'nip' => 'required|string|max:255|unique:gurus,nip,' . $this->id, // NIP wajib, unik kecuali untuk id ini (update)
            'gender' => 'required|in:L,P', // Gender wajib dan hanya bisa L atau P
            'alamat' => 'required|string', // Alamat wajib dan berupa teks
            'kontak' => 'required|string|max:255', // Kontak wajib berupa teks max 255 karakter
            'email' => 'required|email|max:255|unique:gurus,email,' . $this->id, // Email wajib valid dan unik kecuali untuk id ini
        ];
    }

    // Pesan error kustom untuk validasi
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

    // Simpan data guru (tambah atau update)
    public function save()
    {
        // Validasi input berdasarkan rules()
        $this->validate();

        // Cek apakah ini data baru atau update berdasarkan apakah $id null
        $isNew = is_null($this->id);

        // Simpan data guru, update jika $id ada, insert jika $id null
        $guru = Guru::updateOrCreate(
            ['id' => $this->id], // kondisi pencarian data berdasarkan id
            [
                'nama' => $this->nama,
                'nip' => $this->nip,
                'gender' => $this->gender,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
            ]
        );

        // Simpan aktivitas pengguna (log), mencatat penambahan atau pembaruan guru
        ActivityLog::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'description' => $isNew
                ? 'Menambahkan Guru Baru: ' . $guru->nama
                : 'Memperbarui Data Guru: ' . $guru->nama,
        ]);

        // Tampilkan pesan sukses di session
        session()->flash('message', 'Data guru berhasil disimpan.');

        // Redirect ke route 'guru' (daftar guru)
        return redirect()->route('guru');
    }

    // Render view Livewire
    public function render()
    {
        // Tampilkan view livewire.guru.form
        return view('livewire.guru.form');
    }
}

