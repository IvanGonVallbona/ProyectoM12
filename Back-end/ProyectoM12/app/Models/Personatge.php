<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personatge extends Model
{
    protected $fillable = ['nom', 'nivell', 'classe_id', 'raza_id', 'user_id', 'campanya_id', 'imatge', 'joc_id'];

    protected $casts = [
        'nivell' => 'integer',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campanya()
    {
        return $this->belongsTo(Campanya::class);
    }

    public function esdeveniments()
    {
        return $this->hasMany(Esdeveniment::class);
    }

    public function raza()
    {
        return $this->belongsTo(Raza::class);
    }

    /**
     * Relación con el manual.
     */
    public function manual()
    {
        return $this->belongsTo(Manual::class, 'joc_id');
    }
}
