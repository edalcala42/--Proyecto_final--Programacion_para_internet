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
    public function juego(){
        return $this->belongsTo(Juego::class);
    }
    public function blog(){
        return $this->belongsTo(Blog::class);
    }
}
