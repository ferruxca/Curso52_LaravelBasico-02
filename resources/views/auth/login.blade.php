@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Directiva CSRF para proteger contra ataques CSRF -->

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required autofocus>
                                <!-- Campo de entrada para el correo electrónico -->
                                <!-- Verifica errores de validación para el campo 'email' -->
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    <!-- Muestra el mensaje de error si lo hay -->
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                <!-- Campo de entrada para la contraseña -->
                                <!-- Verifica errores de validación para el campo 'password' -->
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <!-- Checkbox para recordar al usuario -->
                                <label class="form-check-label" for="remember">Recordarme</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Ingresar</button>
                            <!-- Botón para enviar el formulario de login -->
                        </form>

                        <div class="mb-3 text-end">
                            <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
