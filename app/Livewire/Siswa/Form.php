<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Siswa;
use Livewire\WithFileUploads;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    // Mengaktifkan fitur upload file pada Livewire
    use WithFileUploads;

    // Deklarasi properti untuk data siswa
    public $id, $nama, $nis, $gender, $alamat, $kontak, $email, $foto, $existingFoto;
    public $status_lapor_pkl = 'no'; // Default status PKL

    // Inisialisasi data ketika komponen di-mount (terutama saat edit)
    public function mount($id = null)
    {
        if ($id) {
            $siswa = Siswa::findOrFail($id);

            // Isi properti berdasarkan data dari database
            $this->id = $siswa->id;
            $this->nama = $siswa->nama;
            $this->existingFoto = $siswa->foto; // Simpan nama file foto lama
            $this->nis = $siswa->nis;
            $this->gender = $siswa->gender;
            $this->alamat = $siswa->alamat;
            $this->kontak = $siswa->kontak;
            $this->email = $siswa->email;
            $this->status_lapor_pkl = $siswa->status_lapor_pkl;
        }
    }

    // Validasi input form
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048', // Maksimal 2MB
            'nis' => 'required|string|max:255|unique:siswas,nis,' . $this->id, // Unik kecuali saat edit
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:siswas,email,' . $this->id,
            'status_lapor_pkl' => 'required|in:no,yes',
        ];
    }

    // Pesan error custom saat validasi gagal
    public function messages()
    {
        return [
            'nama.required' => 'Nama siswa harus diisi.',
            'nama.string' => 'Nama siswa harus berupa teks.',
            'nama.max' => 'Nama siswa maksimal 255 karakter.',

            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',

            'nis.required' => 'NIS harus diisi.',
            'nis.string' => 'NIS harus berupa teks.',
            'nis.max' => 'NIS maksimal 255 karakter.',
            'nis.unique' => 'NIS sudah terdaftar.',

            'gender.required' => 'Jenis kelamin harus dipilih.',
            'gender.in' => 'Jenis kelamin harus L atau P.',

            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',

            'kontak.required' => 'Kontak harus diisi.',
            'kontak.string' => 'Kontak harus berupa teks.',

            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'status_lapor_pkl.required' => 'Status laporan PKL harus diisi.',
            'status_lapor_pkl.in' => 'Status laporan PKL harus bernilai "yes" atau "no".',
        ];
    }

    // Fungsi untuk menyimpan data siswa (baik tambah baru atau edit)
    public function save()
    {
        // Lakukan validasi
        $this->validate();

        // Simpan foto jika diupload, jika tidak gunakan foto lama
        if ($this->foto) {
            $fotoPath = $this->foto->store('foto_siswa', 'public'); // Simpan ke storage/public/foto_siswa
        } else {
            $fotoPath = $this->existingFoto; // Gunakan foto lama
        }

        // Cek apakah ini data baru atau update
        $isNew = is_null($this->id);

        // Simpan atau update data siswa
        $siswa = Siswa::updateOrCreate(
            ['id' => $this->id],
            [
                'nama' => $this->nama,
                'nis' => $this->nis,
                'gender' => $this->gender,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
                'foto' => $fotoPath,
                'status_lapor_pkl' => $this->status_lapor_pkl,
            ]
        );

        // Catat aktivitas user (log)
        ActivityLog::create([
            'user_id' => Auth::id(), // Ambil user yang login
            'description' => $isNew
                ? 'Menambahkan Siswa Baru: ' . $siswa->nama
                : 'Memperbarui Data Siswa: ' . $siswa->nama,
        ]);

        // Kirim notifikasi flash
        session()->flash('message', 'Data siswa berhasil disimpan.');

        // Redirect ke halaman daftar siswa
        return redirect()->route('siswa');
    }

    // Fungsi untuk menghapus foto siswa (preview dan file)
    public function hapusFoto()
    {
        // Hapus preview di Livewire
        $this->foto = null;
        $this->existingFoto = null;

        // Jika sedang mengedit dan ada file lama di storage, hapus juga
        if ($this->id && $this->existingFoto && \Storage::disk('public')->exists($this->existingFoto)) {
            \Storage::disk('public')->delete($this->existingFoto);
        }
    }

    // Render view form Livewire
    public function render()
    {
        return view('livewire.siswa.form');
    }
}
