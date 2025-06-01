<?php

namespace App\Livewire\Pkl;

use App\Models\Guru;
use App\Models\Industri;
use App\Models\Pkl;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\ActivityLog;

class Form extends Component
{
    // Deklarasi properti yang mewakili kolom tabel PKL dan list dropdown
    public $id, $siswa_id, $industri_id, $guru_id, $mulai, $selesai;
    public $siswaList = [];
    public $industriList = [];
    public $guruList = [];
    public $userMail;
    public $showDuplicateModal = false; // untuk menampilkan modal jika ada data ganda

    // Fungsi mount dipanggil saat komponen diinisialisasi
    public function mount($id = null)
    {
        $this->userMail = Auth::user()->email; // ambil email user login
        $this->siswaList = Siswa::where('email', $this->userMail)->get(); // ambil data siswa berdasarkan email login (mungkin hanya 1)
        $this->industriList = Industri::all(); // ambil semua data industri untuk dropdown
        $this->guruList = Guru::all(); // ambil semua data guru untuk dropdown

        if ($id) {
            // Jika ada ID (edit), ambil data PKL yang bersangkutan dari DB dan isi properti
            $pkl = Pkl::findOrFail($id);
            $this->id = $pkl->id;
            $this->siswa_id = $pkl->siswa_id;
            $this->industri_id = $pkl->industri_id;
            $this->guru_id = $pkl->guru_id;
            $this->mulai = $pkl->mulai;
            $this->selesai = $pkl->selesai;
        }
    }

    // Aturan validasi input
    public function rules()
    {
        return [
            'siswa_id' => 'required|exists:siswas,id', // siswa harus dipilih dan ada di tabel siswas
            'industri_id' => 'required|exists:industris,id', // industri harus dipilih dan ada di tabel industris
            'guru_id' => 'required|exists:gurus,id', // guru harus dipilih dan ada di tabel gurus
            'mulai' => 'required|date', // tanggal mulai wajib dan harus valid tanggal
            'selesai' => 'required|date|after:mulai', // tanggal selesai wajib, valid tanggal, dan setelah tanggal mulai
        ];
    }

    // Pesan validasi kustom untuk menampilkan pesan error yang jelas
    public function messages()
    {
        return [
            'siswa_id.required' => 'Silakan pilih siswa.',
            'industri_id.required' => 'Silakan pilih industri.',
            'guru_id.required' => 'Silakan pilih guru pembimbing.',
            'mulai.required' => 'Tanggal mulai harus diisi.',
            'mulai.date' => 'Format tanggal mulai tidak valid.',
            'selesai.required' => 'Tanggal selesai harus diisi.',
            'selesai.date' => 'Format tanggal selesai tidak valid.',
            'selesai.after' => 'Tanggal selesai harus setelah tanggal mulai.',
        ];
    }

    // Fungsi simpan data PKL
    public function save()
    {
        $this->validate(); // validasi input berdasarkan rules()

        DB::beginTransaction(); // mulai transaksi DB agar aman jika error rollback

        try {
            // Ambil data siswa berdasarkan email user login
            $siswa = Siswa::where('email', $this->userMail)->first();

            if (!$siswa) {
                // Jika siswa tidak ditemukan, rollback dan redirect
                DB::rollBack();
                session()->flash('message', 'Siswa tidak ditemukan.');
                return redirect()->route('pkl');
            }

            // Cek jika sedang tambah data baru dan siswa sudah punya data PKL (hindari duplikasi)
            if (!$this->id && Pkl::where('siswa_id', $siswa->id)->exists()) {
                DB::rollBack();
                $this->showDuplicateModal = true; // tampilkan modal peringatan
                return; // hentikan proses simpan
            }

            $isNew = is_null($this->id); // cek apakah ini insert atau update

            // Simpan atau update data PKL
            $pkl = Pkl::updateOrCreate(
                ['id' => $this->id],
                [
                    'siswa_id' => $siswa->id, // paksa siswa_id sesuai user login (tidak dari input)
                    'industri_id' => $this->industri_id,
                    'guru_id' => $this->guru_id,
                    'mulai' => $this->mulai,
                    'selesai' => $this->selesai,
                ]
            );

            // Catat aktivitas user (log)
            ActivityLog::create([
                'user_id' => Auth::id(),
                'description' => $isNew
                    ? $siswa->nama . ' Menambahkan data PKL'
                    : $siswa->nama . ' Memperbarui data PKL',
            ]);

            DB::commit(); // commit transaksi DB jika berhasil

            session()->flash('message', 'Laporan PKL berhasil disimpan.');
            return redirect()->route('pkl'); // redirect ke halaman daftar PKL

        } catch (\Exception $e) {
            DB::rollBack(); // rollback jika ada error
            return redirect()->route('pkl')->with('error', 'Terjadi kesalahan teknis, silakan ulangi.');
        }
    }

    // Render view Blade yang berisi form input PKL
    public function render()
    {
        return view('livewire.pkl.form');
    }
}
