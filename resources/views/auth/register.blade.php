@extends('layouts.app')
<!-- Hereda la plantilla principal 'layouts.app' -->

@section('content')
    <!-- Sección 'content' donde se insertará el contenido -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Registro') }}</div>
                    <!-- Encabezado de la tarjeta -->

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            <!-- Formulario POST que envía los datos a la ruta 'register' -->
                            @csrf
                            <!-- Directiva CSRF para seguridad -->

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required autofocus>
                                <!-- Campo de texto 'name', con validación y valor previo si existe-->
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    <!-- Mensaje de error específico para 'name' -->
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                <!-- Campo de email, con validación y valor previo si existe-->
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    <!-- Mensaje de error específico para 'email' -->
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                <!-- Campo de contraseña, con validación -->
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    <!-- Mensaje de error específico para 'password' -->
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password-confirm"
                                    name="password_confirmation" required>
                                <!-- Campo de confirmación de contraseña -->
                            </div>

                            <button type="submit" class="btn btn-primary">Registrarse</button>
                            <!-- Botón para enviar el formulario -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
