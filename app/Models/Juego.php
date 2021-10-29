<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descripcion', 
        'fecha_de_publicacion',
        'empresa_editora',
    ];
    public function generos(){
        return $this->belongsToMany(Genero::class);
    }
    public function imagenes(){
        return $this->hasMany(Imagen::class);
    }
}
