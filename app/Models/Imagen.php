<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    public function juego(){
        return $this->belongsTo(Juego::class);
    }
    protected $table = 'imagenes';
}
