@component('mail::message')
    # Restablecer Contraseña

    Haz click en el botón para restablecer tu contraseña.

    @component('mail::button', ['url' => $url, 'color' => 'primary'])
        Restablecer Contraseña
    @endcomponent

    Este enlace expirará en {{ config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') }} minutos.

    Si no solicitaste este restablecimiento, ignora este mensaje.
@endcomponent
