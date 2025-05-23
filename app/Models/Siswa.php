<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Model
{
    use HasFactory,HasApiTokens;

    // Tambahkan baris ini untuk memastikan Laravel tahu nama tabelnya
    protected $table = 'siswas';

    protected $fillable = ['nama', 'nis', 'gender', 'alamat', 'kontak', 'email', 'foto', 'status_lapor_pkl'];

    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }
}


