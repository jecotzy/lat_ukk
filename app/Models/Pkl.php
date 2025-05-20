<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pkl extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'industri_id', 'guru_id', 'mulai', 'selesai'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    protected static function booted()
{
    static::created(function ($pkl) {
        $pkl->siswa()->update(['status_lapor_pkl' => 'yes']);
    });

    // Jika kamu juga ingin mengubah kembali ke 'no' jika PKL dihapus:
    static::deleted(function ($pkl) {
        // Cek apakah siswa ini masih punya PKL lain
        if ($pkl->siswa->pkls()->count() === 0) {
            $pkl->siswa()->update(['status_lapor_pkl' => 'no']);
        }
    });
}

}
