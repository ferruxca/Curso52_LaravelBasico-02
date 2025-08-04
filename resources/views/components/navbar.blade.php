<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/"> {{ $title ?? 'Laravel App' }} </a>
        <div class="collapse navbar-collapse">
            @auth
                <ul class="navbar-nav">
                    @if (auth()->user()->hasRole('user'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                        </li>
                    @endif

                    @if (auth()->user()->hasRole('admin'))
                        {{-- @if (auth()->user()->hasRole('editor')) --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                        </li>
                    @endif

                    @if (auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Administracion de Roles</a>
                        </li>
                    @endif
                </ul>
            @endauth

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Cerrar sesión</button>
                        </form>
                    </li>
                @else
                    <!-- Si el usuario NO está autenticado, se mostrarán estos enlaces -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
