<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campanya extends Model
{
    use HasFactory;

    protected $table = 'campanyes';

    protected $fillable = [
        'nom',
        'descripcio',
        'estat',
        'joc_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personatgesCampanya()
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

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_campanya');
    }
    public function registres()
    {
        return $this->hasMany(Registre::class);
    }
}
