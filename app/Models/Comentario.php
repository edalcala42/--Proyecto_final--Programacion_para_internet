<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'comentario',
    ];
    public function juegos(){
        return $this->belongsToMany(Juego::class);
    }
}
