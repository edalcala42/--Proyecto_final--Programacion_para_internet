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
    <a href="{{route('main_page')}}">Otros juegos disponibles</a>
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
        Precio:
        <li>{{ $juego->precio }}</li>
        <br>
        <?php if(isset($sesion_admin)) : ?>
            Registrado en el sistema:
            <li>{{ $juego->created_at }}</li>
            <br>
            Última edición:
            <li>{{ $juego->updated_at }}</li>
            Añadido por el usuario:
            <li>{{ $juego->user_id }}</li>
        <?php endif; ?>
    </ul>
    <?php if(isset($sesion_invitado)) : ?>
        <hr>
        <a href="{{ route('login') }}"><h4>Si deseas adquirir este juego, por favor inicia sesión dando clic aquí.</h4></a>
        <a href="{{ route('register') }}"><h4>Y si no tienes un cuenta, puedes crear una aquí.</h4></a>
        <hr>
    <?php endif; ?>
    
    <?php if(isset($sesion_usuario)) : ?>
        <form action="{{ route('store-comentario', $juego->id)}}" method="GET" enctype="multipart/form-data">
        @csrf
            <li class="form-line" data-type="control_textarea" id="id_8">
                <label class="form-label form-label-top form-label-auto" id="label_8" for="input_8">¿Te gustaría dejar algún comentario al respecto?<br> </label>
                <div id="cid_8" class="form-input-wide" data-layout="full">
                    <textarea id="input_8" class="form-textarea" name="comentario" style="width:648px;height:163px" data-component="textarea" aria-labelledby="label_8" value="{{ $juego->descripcion ?? ''}}"></textarea>
                </div>
            </li>
            <input type="submit" value="Enviar">
        </form>
        <hr>
        <a href="{{ route('enviar-correo') }}">Comprar Juego</a>
    <?php endif; ?>
      
    <?php if(isset($editar)) : ?>
        <hr>
        <a href="{{route('juegos.edit', $juego->id)}}">Editar</a>
        <hr>
        <form action="{{ route('juegos.destroy', $juego) }}" method="post">
            @method('DELETE')
            @csrf
        <input type="submit" value="Eliminar">
    </form>
    <?php endif; ?>
</body>
</html>