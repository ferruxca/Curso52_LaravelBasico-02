@extends('layouts.app')

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <div></div>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <h1 class="display-4 mb-3">{{ $post->title }}</h1>
            <div class="text-muted mb-4">
                <small>
                    Autor: {{ $post->user->name }} |
                    Publicado: {{ $post->created_at ? $post->created_at->format('d/m/Y') : 'N/A' }}
                    @if ($post->created_at != $post->updated_at)
                        | Editado: {{ $post->updated_at ? $post->updated_at->format('d/m/Y') : 'N/A' }}
                    @endif
                </small>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="lead">{{ $post->body }}</p>
                </div>
                <hr>
                <div class="card-body">
                    <div class="form-comments">
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <label for="comment">Comentario</label>
                                <textarea class="form-control" id="content" name="comment" rows="3" required></textarea>
                                @error('comment')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                        </form>
                    </div>
                    <div class="comments mt-4">
                        <h5 class="mb-3">Comentarios</h5>
                        @forelse ($post->comments as $comment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p class="mb-1">{{ $comment->comment }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-user"></i> {{ $comment->user->name }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> {{ $comment->created_at->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                No hay comentarios aún. ¡Sé el primero en comentar!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
