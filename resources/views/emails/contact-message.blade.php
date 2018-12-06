@component('mail::message')
# {{ $data['name'] }} ({{ $data['email'] }}) escribió el siguiente mensaje:

{{ $data['message'] }}

Gracias,<br>
El equipo de {{ config('app.name') }}
@endcomponent
