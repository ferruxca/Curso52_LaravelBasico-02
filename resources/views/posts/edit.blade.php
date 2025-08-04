@extends('layouts.app')

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>Edit Post</div>
        <div>
            <a href="{{ route('post.index') }}" class="btn btn-primary">Regresar</a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('post.update', $post->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <x-formfields :post="$post" />
            <!--  @include('components.formfields') -->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
