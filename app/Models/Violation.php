<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    protected $fillable = ['id','nama_pelanggaran','poin_pelanggaran'];

    public function pelanggaran()
    {
        return $this->hasMany(pelanggaran::class);
    }
}
