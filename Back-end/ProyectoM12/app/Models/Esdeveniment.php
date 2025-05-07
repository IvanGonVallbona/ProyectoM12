<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Esdeveniment extends Model
{
    protected $fillable = ['nom', 'descripcio', 'data', 'tipus', 'user_id'];
    
    protected $casts = [
        'data' => 'date',
    ];

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'esdeveniment_user');
    }
}
