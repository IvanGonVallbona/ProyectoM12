<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    protected $fillable = ['nom', 'descripcio'];

    public function personatges()
    {
        return $this->hasMany(Personatge::class);
    }
}
