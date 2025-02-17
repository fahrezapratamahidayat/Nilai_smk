<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Helper methods untuk cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isGuru()
    {
        return $this->role === 'guru';
    }

    public function isWaliKelas()
    {
        return $this->role === 'walikelas';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    // Relationships
    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function nilaiSiswa()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }

    public function nilaiGuru()
    {
        return $this->hasMany(Nilai::class, 'guru_id');
    }

    public function walikelas()
    {
        return $this->hasOne(WaliKelas::class);
    }

    // Scope queries
    public function scopeGuru($query)
    {
        return $query->where('role', 'guru');
    }

    public function scopeSiswa($query)
    {
        return $query->where('role', 'siswa');
    }

    public function scopeWaliKelas($query)
    {
        return $query->where('role', 'walikelas');
    }
}
