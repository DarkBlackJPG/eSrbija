@component('mail::message')
# Header

Objavljeno je novo obaveštenje u kategoriji na koju ste pretplaćeni!
<br>
@component('mail::panel')
{{$obavestenje->naslov}}
@endcomponent
<br>
Posetite e-Srbija da ga pročitate.

@component('mail::button', ['url' => 'localhost:8000/home'])
e-Srbija
@endcomponent

@endcomponent
