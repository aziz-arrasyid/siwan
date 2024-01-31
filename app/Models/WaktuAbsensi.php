<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuAbsensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function absensi() {
        return $this->hasMany(Absensi::class);
    }

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }
}
