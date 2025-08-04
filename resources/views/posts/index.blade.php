@extends('layouts.app')

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>Post</div>
        <div>
            <a href="{{ route('post.create') }}" class="btn btn-primary">Crear Post</a>
        </div>
    </div>

    <div class="card-body">
        @if ($posts->isEmpty())
            <div class="alert alert-info" role="alert">
                No hay posts disponibles.
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col"><i class="fa-solid fa-comment"></i></th>
                        <th scope="col">Creación</th>
                        <th scope="col">Modificación</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->comments->count() }}</td>
                        <td>{{ $post->created_at ? $post->created_at->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $post->updated_at ? $post->updated_at->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-secondary"><i
                                    class="fa-solid fa-pencil"></i></a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('¿Estás seguro que deseas eliminar este post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
