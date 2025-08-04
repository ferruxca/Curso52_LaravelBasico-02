@extends('layouts.app')

@section('content')
    <div class="card-header">Create Post</div>

    <div class="card-body">

        <form action="{{ route('post.store') }}" method="POST" novalidate>
            @csrf

            <x-formfields :post="$post" />

            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
