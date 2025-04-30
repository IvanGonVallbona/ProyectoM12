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
