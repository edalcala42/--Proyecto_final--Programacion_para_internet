<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Información de {{ $juego->titulo }}</h1>
    <a href="{{route('juegos.index')}}">Listado de juegos</a>
    <ul>
        <li>{{ $juego->descripcion }} {{ $juego->apellido_materno }}</li>
        <li>{{ $juego->fecha_de_publicacion}}</li>
        <li>{{ $juego->empresa_editora }}</li>
    </ul>
    
    <a href="{{route('juegos.edit', $juego->id)}}">Editar</a>
    <hr>
    <form action="{{ route('juegos.destroy', $juego) }}" method="post">
        @method('DELETE')
        @csrf
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>