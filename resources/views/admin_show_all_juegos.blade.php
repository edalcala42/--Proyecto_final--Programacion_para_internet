<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de juegos</title>
</head>
<body>
    <h1>Juegos registrados.</h1>
    <a href="{{ route('juegos.create') }}">Agregar un nuevo juego.</a>
    <table border="1">
        <thead>
            <tr>
                <th>Genero(s)</th>
                <th>ID</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Fecha de publicacion</th>
                <th>Empresa editora</th>
                <th>Añadido</th>
                <th>Última edición</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($juegos as $juego)
                <tr>
                    <td>
                        <ol>
                            @foreach($juego->generos as $genero)
                                <li> {{$genero->nombre_genero}} </li>
                            @endforeach
                        </ol>
                    </td>
                    <td><a href="{{ route('juegos.show', $juego) }}">
                            {{ $juego->id }}
                        </a>
                    </td>
                    <td>{{ $juego->titulo }}</td>
                    <td>{{ $juego->descripcion }}</td>
                    <td>{{ $juego->fecha_de_publicacion }}</td>
                    <td>{{ $juego->empresa_editora }}</td>
                    <td>{{ $juego->created_at }}</td>
                    <td>{{ $juego->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>