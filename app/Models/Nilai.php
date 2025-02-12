<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';

    protected $fillable = [
        'user_id',
        'mata_pelajaran',
        'nilai',
        'semester',
        'tahun_ajaran'
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
