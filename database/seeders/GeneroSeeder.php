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
            'nombre_genero'=>'Survival Horror',
            'descripcion_genero'=>'Son juegos que tratan de transmitir sensaciones de temor y preocupación constante a los jugadores al someterlos a escenarios de supervivencia en los que se debe de administrar una serie de recursos limitados y además, sobrevivir a los horrores que acechan a la vuelta de la esquina.'
        ]);
    }
}
