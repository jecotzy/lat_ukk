<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pkl extends Model
{
    use HasFactory;

    protected $table = 'pkls';
    protected $fillable = [
        'siswa_id',
        'industri_id',
        'guru_id',
        'mulai',
        'selesai'
    ];

    /**
    * Relasi many-to-one ke model Siswa
    *Setiap data PKL (praktik kerja lapangan) hanya dimiliki oleh satu siswa*/
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
    * Relasi many-to-one ke model Industri
    *Setiap data PKL hanya terjadi di satu industri, tetapi satu industri bisa menerima banyak siswa PKL.*/
    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }

    /**
    * Relasi many-to-one ke model Guru
    *Setiap data PKL dibimbing oleh satu guru pembimbing,tetapi satu guru bisa membimbing banyak siswa PKL.*/
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
