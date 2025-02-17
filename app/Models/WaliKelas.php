<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'wali_kelas';

    protected $fillable = [
        'name',
        'email',
        'password',
        'kelas_ajar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
