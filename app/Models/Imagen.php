<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    protected $table = 'imagenes';
    protected $fillable = [
        'imagen_original',
        'imagen_ruta',
        'mime',
    ];
    public function juego(){
        return $this->belongsTo(Juego::class);
    }
    public function blog(){
        return $this->belongsTo(Blog::class);
    }
}
