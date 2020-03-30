@component('mail::message')
# Zahtev za promenu lozinke

Molimo vas da pritisnete prilozen link kako biste uspesno
zamenili sifru.

Link traje 60 minuta.

@component('mail::button', ['url' => $url])
Promeni lozinku
@endcomponent

---
Srdacno, Vasa {{ config('app.name') }}
@endcomponent
