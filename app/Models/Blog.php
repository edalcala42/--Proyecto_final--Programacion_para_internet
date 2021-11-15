<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $hidden = [
        'id',
    ];
    protected $fillable = [
        'user_id',
        'titulo',
        'contenido', 
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function juego(){
        return $this->belongsTo(Juego::class);
    }
    public function imagenes(){
        return $this->hasMany(Imagen::class);
    }
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
}
