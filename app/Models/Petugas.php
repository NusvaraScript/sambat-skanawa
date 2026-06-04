<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Petugas extends Authenticatable
{
    protected $table = 'petugas';

    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'nama_petugas',
        'level',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function tanggapan(): HasMany
    {
        return $this->hasMany(Tanggapan::class, 'petugas_id', 'id');
    }
}
