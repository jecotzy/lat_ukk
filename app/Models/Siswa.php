<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Model
{
    use HasFactory,HasApiTokens;

    // Menentukan nama tabel terkait model ini
    protected $table = 'siswas';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = ['nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'foto', 'status_lapor_pkl'];

    /**
     * Relasi one-to-many: satu siswa bisa memiliki banyak data PKL
     */
    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }
}


