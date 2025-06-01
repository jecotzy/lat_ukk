<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Guru extends Model
{
    use HasFactory,HasApiTokens;

    // Nama tabel yang digunakan
    protected $table = 'gurus';

    // Field yang boleh diisi massal
    protected $fillable = ['nama', 'nip', 'gender', 'alamat', 'kontak', 'email'];

    /**
     * Relasi one-to-many: satu guru membimbing banyak siswa PKL
     */
    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }
}
