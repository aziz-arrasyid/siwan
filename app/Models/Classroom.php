<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = ['id'];

    public function competence(){
		return $this->belongsTo(Competence::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(pelanggaran::class);
    }

    public function waktuAbsensi() {
        return $this->hasMany(WaktuAbsensi::class);
    }
}
