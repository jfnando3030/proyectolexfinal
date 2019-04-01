@component('mail::message')
{{-- Greeting --}}
<div align="center">
        <img src="https://afiliados.bangoenergygel.com/frontend/images/redondo.png" width="150px" height="150px"/>
        </div>
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Error!
@else
# Hola,
@endif
@endif


{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = '#e11a20';
            break;
        case 'error':
            $color = '#e11a20';
            break;
        default:
            $color = '#e11a20';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => '#e11a20'])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Saludos!,<br>El Equipo de Bango Energy Gel
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
Si tienes problemas para hacer clic en el botón "{{ $actionText }}" , copia y pega la URL a continuación
en su navegador web: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
