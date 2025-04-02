<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registre extends Model
{
    use HasFactory;


    protected $table = 'registres';

    protected $fillable = [
        'titol',
        'descripcio'
    ];
}
