<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['nom', 'descripcio', 'joc_id'];

    public static function getName($id)
    {
        return self::where('id', $id)->value('nom');
    }

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

    public function campanyes()
    {
        return $this->belongsToMany(Campanya::class, 'classe_campanya');
    }
}
