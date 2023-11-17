<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $guarded = ['id'];

    public function classroom(){
        return $this->hasMany(Classroom::class);
    }
}
