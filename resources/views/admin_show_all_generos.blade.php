@include('top')
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">
    <x-success-message></x-success-message>
    <x-deleted-message></x-deleted-message>
    <h1>Generos registrados.</h1>
    <a class="text-gray-800 underline hover:text-red-900" href="{{ route('generos.create') }}">Agregar un nuevo genero.</a>
    <table class="table-auto border-separate border border-green-900">
        <thead class="bg-gray-50">
            <tr>
                <th class="w-1/8 ...">ID</th>
                <th class="w-1/8 ...">Nombre</th>
                <th class="w-1/8 ...">Descripcion</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($generos as $genero)
                <tr class="bg-blue-50">
                    <td class="font-serif ..."><a href="{{ route('generos.show', $genero) }}">
                            {{ $genero->id }}
                        </a>
                    </td>
                    <td class="font-serif font-bold hover:text-blue-900"><a href="{{ route('generos.show', $genero) }}">
                        {{ $genero->nombre_genero }}
                        </a>
                    </td>
                    <td class="font-serif ...">{{ $genero->descripcion_genero }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <x-success-message></x-success-message>
    <x-deleted-message></x-deleted-message>
</body>
</html>