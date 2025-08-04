@extends('layouts.app')

@section('content')
    <div class="card-header">Publicaciones</div>
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            @foreach ($posts as $post)
                <div class="col">
                    <div class="card h-100">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <a href="{{ route('post.show', $post->id) }}">
                                <h5 class="card-title">{{ $post->title }}</h5>
                            </a>
                            <p class="card-text">{{ Str::words($post->body, 20, '...') }}</p>
                            {{-- <a href="{{ route('post.show', $post->id) }}" class="btn btn-link px-0">Leer más...</a> --}}
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{ $post->updated_at }}</small>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection
