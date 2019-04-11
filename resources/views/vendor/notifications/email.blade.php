@component('mail::message')
{{-- Greeting --}}
<div align="center">
        <img src="http://35.237.74.133/images/merino.png" width="150px" height="150px"/>
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
            $color = '#000';
            break;
        case 'error':
            $color = '#000';
            break;
        default:
            $color = '#000';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => '#000'])
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
Saludos!,<br>El Equipo de Merino & Asociados
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
Si tienes problemas para hacer clic en el botón "{{ $actionText }}" , copia y pega la URL a continuación
en su navegador web: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
