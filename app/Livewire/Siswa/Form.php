<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Siswa;
use Livewire\WithFileUploads;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    use WithFileUploads;
// Deklarasi variabelnya
    public $id, $nama, $nis, $gender, $alamat, $kontak, $email, $foto, $existingFoto;
    public $status_lapor_pkl = 'no';


    // Mount untuk setiap kolom
    public function mount($id = null)
    {
        if ($id) {
            $siswa = Siswa::findOrFail($id);
            $this->id = $siswa->id;
            $this->nama = $siswa->nama;
            $this->existingFoto = $siswa->foto; // simpan foto lama
            $this->nis = $siswa->nis;
            $this->gender = $siswa->gender;
            $this->alamat = $siswa->alamat;
            $this->kontak = $siswa->kontak;
            $this->email = $siswa->email;
            $this->status_lapor_pkl = $siswa->status_lapor_pkl;
            
        }
    }

    // Validasi kolom (yang wajib diisi)
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'nis' => 'required|string|max:255|unique:siswas,nis,' . $this->id,
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'email' => 'required|email|unique:siswas,email,' . $this->id,
            'status_lapor_pkl' => 'required|in:no,yes',
        ];
    }

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


    

    // Simpan data
 public function save()
{
    $this->validate();

    // Jika ada foto baru diunggah
    if ($this->foto) {
        $fotoPath = $this->foto->store('foto_siswa', 'public');
    } else {
        $fotoPath = $this->existingFoto;
    }

    // Tentukan apakah ini data baru atau update
    $isNew = is_null($this->id);

    // Simpan atau perbarui data siswa dan simpan hasilnya ke variabel $siswa
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

    // Tambahkan log aktivitas
    ActivityLog::create([
        'user_id' => Auth::id(),
        'description' => $isNew
            ? 'Menambahkan Siswa Baru: ' . $siswa->nama
            : 'Memperbarui Data Siswa: ' . $siswa->nama,
    ]);

    session()->flash('message', 'Data siswa berhasil disimpan.');

    return redirect()->route('siswa');
}

public function hapusFoto()
{
    $this->foto = null; // Hapus upload sementara dari Livewire
    $this->existingFoto = null; // Hapus referensi foto lama

    // Jika kamu ingin juga menghapus file lama dari storage (jika sedang edit)
    // pastikan hanya dilakukan jika `existingFoto` sebelumnya ada
    if ($this->id && $this->existingFoto && \Storage::disk('public')->exists($this->existingFoto)) {
        \Storage::disk('public')->delete($this->existingFoto);
    }
}

    // Render
    public function render()
    {
        return view('livewire.siswa.form');
    }

}
