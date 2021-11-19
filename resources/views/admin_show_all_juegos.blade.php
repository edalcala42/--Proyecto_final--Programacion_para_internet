@include('top')
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">
    <x-success-message></x-success-message>
    <x-deleted-message></x-deleted-message>
    <h1 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl mb-8">Juegos registrados.</h1>
    <?php if(isset($sesion_admin)) : ?>
        <a class="text-gray-800 underline hover:text-red-900" href="{{ route('juegos.create') }}">Agregar un nuevo juego.</a>
    <?php endif; ?>
    <table class="table-auto border-separate border border-green-900">
        <thead class="bg-gray-50">
            <tr>
                <th class="w-1/8 ...">Genero(s)</th>
                <th class="w-1/8 ...">ID</th>
                <th class="w-1/8 ...">Titulo</th>
                <th class="w-1/8 ...">Descripcion</th>
                <th class="w-1/8 ...">Fecha de publicacion</th>
                <th class="w-1/8 ...">Empresa editora</th>
                <th class="w-1/8 ...">Añadido</th>
                <th class="w-1/8 ...">Última edición</th>
                <th class="w-1/8 ...">Precio ($mx)</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($juegos as $juego)
                <tr class="bg-blue-50">
                    <td class="font-serif ...">
                        <ul class="list-disc italic">
                            @foreach($juego->generos as $genero)
                                <li> {{$genero->nombre_genero}} </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="font-serif font-bold hover:text-blue-900"><a href="{{ route('juegos.show', $juego) }}">
                            {{ $juego->id }}
                        </a>
                    </td>
                    <td class="font-serif font-bold hover:text-blue-900"><a href="{{ route('juegos.show', $juego) }}">{{ $juego->titulo }}</a></td>
                    <td class="font-serif ...">{{ $juego->descripcion }}</td>
                    <td class="font-serif ...">{{ $juego->fecha_de_publicacion }}</td>
                    <td class="font-serif font-bold">{{ $juego->empresa_editora }}</td>
                    <td class="font-serif ...">{{ $juego->created_at }}</td>
                    <td class="font-serif ...">{{ $juego->updated_at }}</td>
                    <td class="font-serif font-bold hover:text-blue-900"><a href="{{ route('juegos.show', $juego) }}">{{ $juego->precio }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>