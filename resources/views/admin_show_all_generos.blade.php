<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de generos</title>
</head>
<body>
    <h1>Generos registrados.</h1>
    <a href="{{ route('generos.create') }}">Agregar un nuevo genero.</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($generos as $genero)
                <tr>
                    <td><a href="{{ route('generos.show', $genero) }}">
                            {{ $genero->id }}
                        </a>
                    </td>
                    <td>{{ $genero->nombre_genero }}</td>
                    <td>{{ $genero->descripcion_genero }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-success-message></x-success-message>
    <x-deleted-message></x-deleted-message>
</body>
</html>