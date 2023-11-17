<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $guarded = ['id'];

  protected $dates = ['birthdate'];

  public function classroom()
  {
    return $this->belongsTo(Classroom::class);
  }

  public function competence()
  {
    return $this->belongsTo(Competence::class);
  }

  public function pelanggaran()
  {
    return $this->hasMany(pelanggaran::class);
  }

  public function panggilanOrtu()
  {
    return $this->hasOne(PanggilanOrtu::class);
  }
}
