@include('top')
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">
    <x-success-message></x-success-message>
    <div class="w-full container mx-auto flex flex-wrap items-center">
    <h2 class="font-bold text-gray-900">Imagenes del juego:</h2>
    <table class="table-auto border-separate border border-green-900">
        <thead class="bg-gray-50">
            <tr>
                <th class="w-1/2 ...">ID de imagen</th>
                <th class="w-1/2 ...">Nombre de la imagen</th>
                <th class="w-1/2 ...">Ruta</th>
                <th class="w-1/2 ...">¿Deseas eliminarla?</th>
            </tr>
        </thead>
        @foreach ($imagenes as $imagen)
            <tr class="bg-blue-400">
                <td class="font-serif font-bold">{{ $imagen->id }}</td>
                <td class="font-serif font-bold">{{ $imagen->imagen_original }}</td>
                <td>{{ $imagen->imagen_ruta }}</td>
                <td>
                    <form action="{{ route('delete-image', $imagen) }}" method="get">
                        @method('DELETE')
                        @csrf
                    <input type="submit" class="h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800" value="Eliminar">
                </td>
            </tr>
        @endforeach
        <hr>  
    </table>
</div>
</div>