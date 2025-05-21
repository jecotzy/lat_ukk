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
    public $id, $siswa_id, $industri_id, $guru_id, $mulai, $selesai;
    public $siswaList = [];
    public $industriList = [];
    public $guruList = [];
    public $userMail;

    public function mount($id = null)
    {
        $this->userMail = Auth::user()->email;
        $this->siswaList = Siswa::where('email', $this->userMail)->get();
        $this->industriList = Industri::all();
        $this->guruList = Guru::all();

        if ($id) {
            $pkl = Pkl::findOrFail($id);
            $this->id = $pkl->id;
            $this->siswa_id = $pkl->siswa_id;
            $this->industri_id = $pkl->industri_id;
            $this->guru_id = $pkl->guru_id;
            $this->mulai = $pkl->mulai;
            $this->selesai = $pkl->selesai;
        }

        
    }

    public function rules()
    {
        return [
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ];
    }

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


    public function save()
{
    $this->validate();

    DB::beginTransaction();

    try {
        $siswa = Siswa::where('email', $this->userMail)->first();

        if (!$siswa) {
            DB::rollBack();
            session()->flash('message', 'Siswa tidak ditemukan.');
            return redirect()->route('pkl');
        }

        if (!$this->id && Pkl::where('siswa_id', $siswa->id)->exists()) {
            DB::rollBack();
            session()->flash('message', 'Tidak dapat menambahkan,Anda sudah pernah menambahkan');
            return redirect()->route('pkl');
        }

        $isNew = is_null($this->id);

        $pkl = Pkl::updateOrCreate(
            ['id' => $this->id],
            [
                'siswa_id' => $siswa->id, // paksa dari auth
                'industri_id' => $this->industri_id,
                'guru_id' => $this->guru_id,
                'mulai' => $this->mulai,
                'selesai' => $this->selesai,
            ]
        );

        // Simpan log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => $isNew
                ? $siswa->nama . ' Menambahkan data PKL'
                : $siswa->nama . ' Memperbarui data PKL',
        ]);

        DB::commit();
        session()->flash('message', 'Laporan PKL berhasil disimpan.');
        return redirect()->route('pkl');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('pkl')->with('error', 'Terjadi kesalahan teknis, silakan ulangi.');
    }
}



    public function render()
    {
        return view('livewire.pkl.form'); // pastikan file blade ini ada dan hanya berisi form
    }
}
