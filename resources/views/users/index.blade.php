@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h2 mb-4">Administrar Roles de Usuarios</h1>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Roles</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <div class="text-muted">{{ $user->email }}</div>
                                </td>
                                <td>
                                    <form action="{{ route('users.syncRoles', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach ($roles as $role)
                                                <div class="form-check">
                                                    <input type="checkbox" name="role_ids[]" value="{{ $role->id }}"
                                                        @if ($user->roles->contains($role->id)) checked @endif
                                                        class="form-check-input">
                                                    <label class="form-check-label">{{ $role->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                </td>

                                <td>
                                    <button type="submit" class="btn btn-primary">
                                        Guardar Roles
                                    </button>
                                </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
