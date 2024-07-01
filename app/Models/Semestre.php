<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
        'filiere_id',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
}
