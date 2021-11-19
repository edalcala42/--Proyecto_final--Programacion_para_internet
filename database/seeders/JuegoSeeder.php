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
        $juego->titulo = 'NieR: Replicant';
        $juego->descripcion = 'NieR Replicant ver.1.22474487139... es una versión actualizada de NieR Replicant, lanzado originalmente en Japón.
        Descubre una precuela única para la obra maestra NieR:Automata, un título que ha recibido excelentes críticas.
        ¡Con esta modernización disfrutarás de unos gráficos cuidadosamente renovados, una historia fascinante y muchas cosas más!
        El protagonista es un bondadoso joven de una aldea remota que, con el objetivo de salvar a su hermana Yonah, que sufre una enfermedad letal conocida como necrosis rúnica, se dispone a buscar los Versos sellados en compañía del extraño libro parlante Grimoire Weiss.';
        $juego->fecha_de_publicacion = '2021/04/23';
        $juego->empresa_editora = 'Square Enix';
        $juego->precio = '834.50';
        $juego->save();
        $juego->generos()->attach(3);
        $juego->generos()->attach(4);
        $juego->generos()->attach(5);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'The Talos Principle';
        $juego->descripcion = 'Como si te despertaras de un sueño profundo, te encuentras en un mundo extraño y contradictorio de ruinas antiguas y tecnología avanzada. 
        Encargado por tu creador con la resolución de una serie de puzles cada vez más complejos, tienes que decidir si vas a tener fe o si vas a hacer las preguntas difíciles: 
        ¿Quién eres? ¿Cuál es tu propósito? ¿Qué vas a hacer?';
        $juego->fecha_de_publicacion = '2014/12/11';
        $juego->empresa_editora = 'Croteam';
        $juego->precio = '299.99';
        $juego->save();
        $juego->generos()->attach(5);
        $juego->generos()->attach(6);
        $juego->generos()->attach(7);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'GRIS';
        $juego->descripcion = 'Gris is a hopeful young girl lost in her own world, dealing with a painful experience in her life. 
        Her journey through sorrow is manifested in her dress, which grants new abilities to better navigate her faded reality. 
        As the story unfolds, Gris will grow emotionally and see her world in a different way, revealing new paths to explore using her new abilities.';
        $juego->fecha_de_publicacion = '2018/12/13';
        $juego->empresa_editora = 'Nomada Studio';
        $juego->precio = '168.99';
        $juego->save();
        $juego->generos()->attach(5);
        $juego->generos()->attach(7);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'OMORI';
        $juego->descripcion = 'Explore a strange world full of colorful friends and foes. 
        Navigate through the vibrant and the mundane in order to uncover a forgotten past. 
        When the time comes, the path you’ve chosen will determine your fate... and perhaps the fate of others as well.';
        $juego->fecha_de_publicacion = '2020/12/25';
        $juego->empresa_editora = 'OMOCAT';
        $juego->precio = '185.99';
        $juego->save();
        $juego->generos()->attach(4);
        $juego->generos()->attach(5);
        $juego->generos()->attach(7);
        $juego->generos()->attach(9);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'Alice: Madness Returns';
        $juego->descripcion = 'Al igual que el juego anterior American McGees Alice, Alice: Madness Returns se basa en dos obras literarias de Lewis Caroll, Alicia en el País de las Maravillas y A través del espejo. 
        Sin embargo, a diferencia de las novelas de Carroll, el juego desarrolla una versión más oscura, cruel y violenta del País de las Maravillas,
        aunque se desarrolló una estética victoriana y más oscura sobre la realidad de Alice, lo cual mostraría elementos de gore, suspenso y terror psicológico sobre los recuerdos turbios de la protagonista y la sed de venganza a través de matanza o tortura a los enemigos presentados en el mundo de Wonderland.';
        $juego->fecha_de_publicacion = '2011/06/14';
        $juego->empresa_editora = 'Spicy Horse';
        $juego->precio = '259.99';
        $juego->save();
        $juego->generos()->attach(3);
        $juego->generos()->attach(9);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'The Witcher 3: Wild Hunt';
        $juego->descripcion = 'The Witcher: Wild Hunt is a story-driven open world RPG set in a visually stunning fantasy universe full of meaningful choices and impactful consequences. 
        In The Witcher, you play as professional monster hunter Geralt of Rivia tasked with finding a child of prophecy in a vast open world rich with merchant cities, pirate islands, dangerous mountain passes, and forgotten caverns to explore.';
        $juego->fecha_de_publicacion = '2015/05/18';
        $juego->empresa_editora = 'CD PROJEKT RED';
        $juego->precio = '439.99';
        $juego->save();
        $juego->generos()->attach(4);
        $juego->generos()->attach(5);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'Celeste';
        $juego->descripcion = 'Madeline se encuentra determinada a superar el desafio que implica escalar la montaña Celeste, 
        a pesar de no saber el porqué. Aun así, decide emprender el viaje y descubrir lo que le depara en el trayecto 
        hacía la cumbre de la misteriosa montaña.';
        $juego->fecha_de_publicacion = '2017/10/21';
        $juego->empresa_editora = 'Matt Makes Games';
        $juego->precio = '179.99';
        $juego->save();
        $juego->generos()->attach(1);
        $juego->generos()->attach(7);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'Doki Doki Literature Club Plus!';
        $juego->descripcion = 'Welcome to a terrifying world of poetry and romance! Write poems for your crush and erase any mistakes along the way to ensure your perfect ending. Now’s your chance to discover why DDLC is one of the most beloved psychological horror games of the decade!

        You play as the main character, who reluctantly joins the Literature Club in search of a romantic interest. With every poem you write and every choice you make, you’ll charm your crush and begin to unfold the horrors of school romance. Do you have what it takes to crack the code of dating sims and get the perfect ending?
        
        Now, the original mind-shattering DDLC experience is packed with tons of new features and content exclusive to Doki Doki Literature Club Plus!';
        $juego->fecha_de_publicacion = '2021/06/30';
        $juego->empresa_editora = 'Team Salvato';
        $juego->precio = '154.99';
        $juego->save();
        $juego->generos()->attach(7);
        $juego->generos()->attach(8);
        $juego->generos()->attach(9);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'NieR: Automata';
        $juego->descripcion = 'Ambientado en un futuro distópico, donde el mundo ha sido asaltado por alienigenas y la 
        humanidad reside escondida en la luna; tomamos el papel de dos androides que han sido enviados a una misión
        para detener los esfuerzos extraterrestres. El juego toma un enfoque filósofico y explora lo que significa ser
        humano.';
        $juego->fecha_de_publicacion = '2017/03/17';
        $juego->empresa_editora = 'Square Enix';
        $juego->precio = '665.00';
        $juego->save();
        $juego->generos()->attach(3);
        $juego->generos()->attach(4);
        $juego->generos()->attach(5);

        $juego = new Juego();
        $juego->user_id = 1;
        $juego->titulo = 'Bloodstained: Ritual of the Night';
        $juego->descripcion = 'Bloodstained: Ritual of the Night is the FULL game experience, an exploration-focused, side-scroller action RPG packing all of the best features you have come to know and love from the Metroidvania genre into a single, content-packed game.

        Play as Miriam, an orphan scarred by an alchemist’s curse which slowly crystallizes her body. In order to save herself, and indeed, all of humanity, she must battle her way through a demon-infested castle summoned by Gebel, her old friend whose body and mind has become more crystal than flesh.';
        $juego->fecha_de_publicacion = '2019/06/18';
        $juego->empresa_editora = '505 Games';
        $juego->precio = '367.99';
        $juego->save();
        $juego->generos()->attach(4);
        $juego->generos()->attach(7);
        $juego->generos()->attach(10);

    }
}
