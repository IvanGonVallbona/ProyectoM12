<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $fillable = ['nom', 'tipus', 'descripcio', 'jugabilidad', 'imatge'];

    /**
     * Relación con las clases.
     */
    public function classes()
    {
        return $this->hasMany(Classe::class, 'joc_id');
    }

    /**
     * Relación con las razas.
     */
    public function razas()
    {
        return $this->hasMany(Raza::class, 'joc_id');
    }

    /**
     * Relación con las campañas.
     */
    public function campanyes()
    {
        return $this->hasMany(Campanya::class, 'joc_id');
    }

    /**
     * Relación con los personajes.
     */
    public function personatges()
    {
        return $this->hasMany(Personatge::class, 'joc_id');
    }
}
