@include('top')
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">
    <x-success-message></x-success-message>
    <h3 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl mb-8">{{ $genero->titulo }}</h3>
    <br>
    <a class="text-gray-800 underline hover:text-gray-900" href="{{route('generos.index')}}">Otros generos registrados</a>
    <br>
    <ul>
        <h2 class="font-bold text-gray-900">Nombre:</h2>
        <li>{{ $genero->nombre_genero }}</li>
        <br>
        <h2 class="font-bold text-gray-900">Descripción:</h2>
        <li>{{ $genero->descripcion_genero }}</li>
        <br>
        <h2 class="font-bold text-gray-900">Registrado en el sistema:</h2>
        <li>{{ $genero->created_at }}</li>
        <br>
        <h2 class="font-bold text-gray-900">Última edición:</h2>
        <li>{{ $genero->updated_at }}</li>
        <br>
    </ul>
    <hr>
    <br> 
    <hr>
    <a href="{{route('generos.edit', $genero->id)}}">Editar</a>
    <hr>
    <form action="{{ route('generos.destroy', $genero) }}" method="post">
        @method('DELETE')
        @csrf
    <input type="submit" value="Eliminar">
    </form>
</div>
</body>
</html>