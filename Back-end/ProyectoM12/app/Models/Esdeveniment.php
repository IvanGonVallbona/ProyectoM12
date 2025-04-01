<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Esdeveniment extends Model
{
        protected $fillable = [
        'nom',
        'descripcio',
        'data',
        'tipus',
        'user_id',
    ];
    
    protected $casts = [
        'data' => 'date',
    ];
}
