<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'user_id',
        'nip',
        'mata_pelajaran',
        'kelas_ajar',
        'status_guru'
    ];

    // Konstanta untuk kelas
    const KELAS_10 = '10';
    const KELAS_11 = '11';
    const KELAS_12 = '12';

    // Daftar kelas yang tersedia
    public static function getDaftarKelas()
    {
        return [
            self::KELAS_10 => 'Kelas 10',
            self::KELAS_11 => 'Kelas 11',
            self::KELAS_12 => 'Kelas 12'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'guru_id', 'user_id');
    }
}
