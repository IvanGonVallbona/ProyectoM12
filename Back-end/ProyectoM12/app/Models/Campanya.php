<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campanya extends Model
{
    use HasFactory;
    
    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'campanyes';
    
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'descripcio',
        'estat',
        'user_id'
    ];
    
    /**
     * Obtener el usuario que creó la campaña.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener los personajes asociados a la campaña.
     */
    public function personatges()
    {
        return $this->hasMany(Personatge::class);
    }
}
