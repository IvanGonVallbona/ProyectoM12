<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    public function personatges()
    {
        return $this->hasMany(Personatge::class);
    }

    /**
     * Relación con el manual.
     */
    public function manual()
    {
        return $this->belongsTo(Manual::class, 'joc_id');
    }
}
