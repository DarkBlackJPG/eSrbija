@component('mail::message')

# Objavljeno je novo obaveštenje u kategoriji na koju ste pretplaćeni!
<br>
@component('mail::panel')
{{$obavestenje->naslov}}
@endcomponent
<br>
Posetite e-Srbija web stranicu da ga pročitate.

@endcomponent
