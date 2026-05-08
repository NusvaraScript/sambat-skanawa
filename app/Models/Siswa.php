<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';

    protected $primaryKey = 'nis';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $guarded = [];

    protected $fillable = [
        'nis',
        'username',
        'nama_siswa',
        'kelas',
        'no_hp',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName(): string
    {
        return 'nis';
    }

    public function siswa(): HasMany
    {
        return $this->pengaduan();
    }

    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class, 'siswa_nis', 'nis');
    }
}
