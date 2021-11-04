<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de {{ $juego->titulo }}</title>
</head>
<body>
    <h1>Información de {{ $juego->titulo }}</h1>
    <a href="{{route('juegos.index')}}">Datos del juego</a>
    <ul>
        Descripcion:
        <li>{{ $juego->descripcion }} {{ $juego->apellido_materno }}</li>
        <br>
        Fecha de publicación:
        <li>{{ $juego->fecha_de_publicacion }}</li>
        <br>
        Empresa editora:
        <li>{{ $juego->empresa_editora }}</li>
        <br>
        Registrado en el sistema:
        <li>{{ $juego->created_at }}</li>
        <br>
        Última edición:
        <li>{{ $juego->updated_at }}</li>
        Añadido por el usuario:
        <li>{{ $juego->user_id }}</li>
    </ul>
    <hr>
    <hr>
    <a href="{{route('juegos.edit', $juego->id)}}">Editar</a>
    <hr>
    <form action="{{ route('juegos.destroy', $juego) }}" method="post">
        @method('DELETE')
        @csrf
        <input type="submit" value="Eliminar">
    </form>
    <hr>
    <a href="{{ route('enviar-correo') }}">Comprar Juego</a>
</body>
</html>