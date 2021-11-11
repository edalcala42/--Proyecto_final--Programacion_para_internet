<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;

class JuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'Silent Hill 2';
        $juego->descripcion = 'Silent Hill 2 explora la historia de James Sunderland, quien se encuentra superando la repentina
        perdida de su querida Mary. Un día, recibe una carta de su difunto amor, quien lo invita a pasar el tiempo juntos 
        en Silent Hill. James, extrañado por esta situación, decide realizar un viaje que lo llevará hacía la verdad.';
        $juego->fecha_de_publicacion = '2001/09/29';
        $juego->empresa_editora = 'Konami';
        $juego->precio = '150.55';
        $juego->save();
        $juego->generos()->attach(2);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'Nier: Automata';
        $juego->descripcion = 'Ambientado en un futuro distópico, donde el mundo ha sido asaltado por alienigenas y la 
        humanidad reside escondida en la luna; tomamos el papel de dos androides que han sido enviados a una misión
        para detener los esfuerzos extraterrestres. El juego toma un enfoque filósofico y explora lo que significa ser
        humano.';
        $juego->fecha_de_publicacion = '2015/10/21';
        $juego->empresa_editora = 'Square Enix';
        $juego->precio = '250.50';
        $juego->save();
        $juego->generos()->attach(3);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'Celeste';
        $juego->descripcion = 'Madeline se encuentra determinada a superar el desafio que implica escalar la montaña Celeste, 
        a pesar de no saber el porqué. Aun así, decide emprender el viaje y descubrir lo que le depara en el trayecto 
        hacía la cumbre de la misteriosa montaña.';
        $juego->fecha_de_publicacion = '2017/10/21';
        $juego->empresa_editora = 'Matt Makes Games';
        $juego->precio = '110.00';
        $juego->save();
        $juego->generos()->attach(1);
    }
}
