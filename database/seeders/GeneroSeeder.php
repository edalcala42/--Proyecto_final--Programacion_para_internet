<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Genero;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genero::create([
            'nombre_genero'=>'Plataformas',
            'descripcion_genero'=>'Se trata de juegos que requieren de habilidad y destreza por parte del jugador para abrise camino a través del mapa por medio de plataformas.'
        ]);
        Genero::create([
            'nombre_genero'=>'Survival Horror',
            'descripcion_genero'=>'Son juegos que tratan de transmitir sensaciones de temor y preocupación constante a los jugadores al someterlos a escenarios de supervivencia en los que se debe de administrar una serie de recursos limitados y además, sobrevivir a los horrores que acechan a la vuelta de la esquina.'
        ]);
        Genero::create([
            'nombre_genero'=>'Hack and slash',
            'descripcion_genero'=>'Son juegos enfocados a la acción y adrenalina que implica enfrentarse a un gran número de enemigos al mismo tiempo. Suelen causar una inmensa satisfacción por lo bien que se siente controlar a los personajes y atacar a los enemigos.'
        ]);
        Genero::create([
            'nombre_genero'=>'RPG',
            'descripcion_genero'=>'Se trata de juegos en los que se hace uso de un sistema de magia o items que permiten al personaje subir de nivel para hacer frente a las amenazas que lo acechan. Así como en los juegos de mesa de rol.'
        ]);
        Genero::create([
            'nombre_genero'=>'Aventura',
            'descripcion_genero'=>'Son juegos con enfoque en la exploración y aventura como parte de sus atractivos.'
        ]);
        Genero::create([
            'nombre_genero'=>'Puzzles',
            'descripcion_genero'=>'Se trata de juegos que cuentan con secciones en las cuales el jugador tiene que resolver acertijos en forma de mecánicas de juego para progresar. La saga de Portal es muy popular por hacer popular a este género.'
        ]);
        Genero::create([
            'nombre_genero'=>'Indie',
            'descripcion_genero'=>'Son juegos desarrollados por pequeñas organizaciones que no cuentan con grandes presupuestos como lo hacen los títulos AAA.'
        ]);
        Genero::create([
            'nombre_genero'=>'Novela gráfica',
            'descripcion_genero'=>'Son juegos centrados en contar una historia con el estilo de las novelas que se encuentran en los libros, pero de forma gráfica y con interacción del juegador.'
        ]);
        Genero::create([
            'nombre_genero'=>'Terror psicológico',
            'descripcion_genero'=>'Se trata de juegos que hacen uso de elementos simbólicos o temáticas que aluden al perturbado estado mental de sus personajes, e integran estos elementos a la jugabilidad para hacer al jugador participe de la historia.'
        ]);
        Genero::create([
            'nombre_genero'=>'Metroidvania',
            'descripcion_genero'=>'Es un estilo de juego que se caracteriza por la exploración de un gran mapa que se encuentra interconectado y que para ser accedido en su totalidad, requiere del progreso del jugador. Suelen mezclar elementos de plataformas, hack & slash y combate en general.'
        ]);
    }
}
