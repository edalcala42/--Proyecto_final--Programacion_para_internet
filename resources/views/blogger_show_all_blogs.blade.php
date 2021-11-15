<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de blogs</title>
</head>
<body>
    <h1>Blogs registrados.</h1>
    <a href="{{ route('blogs.create') }}">Agregar un nuevo blog.</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td><a href="{{ route('blogs.show', $blog) }}">
                            {{ $blog->id }}
                        </a>
                    </td>
                    <td>{{ $blog->titulo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>