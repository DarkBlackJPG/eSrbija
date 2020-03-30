@component('mail::message')
# Potvrda email adrese

Postovani korisnice, zeleli bismo da Vas zamolimo da potvrdite
email adresu pritiskom na prilozeni link.

Link je validan 24 casa od registracije, nakon toga vise nece biti validan.

@component('mail::button', ['url' => $url])
Verifikacija
@endcomponent
Srdacno,
Vasa {{ config('app.name') }}
@component('mail::subcopy')
    Ukoliko Vam ne radi dugme, mozete preko prilozenog [linka]({{$url}}).
@endcomponent

@endcomponent
