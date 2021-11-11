<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Juego extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $hidden = [
        'id',
    ];
    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion', 
        'fecha_de_publicacion',
        'empresa_editora',
        'precio',
    ];
    public function generos(){
        return $this->belongsToMany(Genero::class);
    }
    public function imagenes(){
        return $this->hasMany(Imagen::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comentarios(){
        return $this->belongsToMany(Comentario::class);
    }
}
