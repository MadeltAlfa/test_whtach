<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPegawai extends Model
{
    use HasFactory;

    protected $table = 'jenis_pegawais';

    protected $fillable = ['jenis_pegawai'];

    public function statusPegawais(): HasMany
    {
        return $this->hasMany(StatusPegawai::class);
    }
}
