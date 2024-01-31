<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = ['id'];

    protected $date = ['birthdate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroom()
    {
        return $this->hasOne(Classroom::class);
    }

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class);
    }

    public function absensi() {
        return $this->hasMany(Absensi::class);
    }
}
