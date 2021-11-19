@include('top')
<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">
    <x-success-message></x-success-message>
    <x-deleted-message></x-deleted-message>
    <h1 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl mb-8">Blogs registrados.</h1>
    <a class="text-gray-800 underline hover:text-red-900" href="{{ route('blogs.create') }}">Agregar un nuevo blog.</a>
    <table class="table-auto border-separate border border-green-900">
        <thead class="bg-gray-50">
            <tr>
                <th class="w-1/8 ...">ID</th>
                <th class="w-1/8 ...">Titulo</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($blogs as $blog)
                <tr class="bg-blue-50">
                    <td class="font-serif font-bold hover:text-blue-900"><a href="{{ route('blogs.show', $blog) }}">
                            {{ $blog->id }}
                        </a>
                    </td>
                    <td class="font-serif font-italic hover:text-blue-900"><a href="{{ route('blogs.show', $blog) }}">{{ $blog->titulo }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>