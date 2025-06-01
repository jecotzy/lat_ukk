<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Industri extends Model
{
    use HasFactory;

    protected $table = 'industris';

    protected $fillable = [
        'nama', 'bidang_usaha', 'alamat', 'kontak', 'email', 'website'
    ];

    /**
     * Relasi one-to-many: satu industri bisa menerima banyak siswa PKL
     */
    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }
}
