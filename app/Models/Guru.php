<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Guru extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'gurus';

    protected $fillable = ['nama', 'nip', 'gender', 'alamat', 'kontak', 'email'];

    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }
}
