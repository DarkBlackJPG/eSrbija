@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/authentication.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card no-padding">
                <div class="card-header">{{ __('Potvrdite Vasu email adresu') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Poslata poruka',
                                text: 'Poslali smo Vam link! Pogledajte "spam" sanduce ukoliko ne vidite u regularnom sanducetu poruku.',
                                confirmButtonText: 'Razumem',
                            })
                        </script>
                    @endif

                    {{ __('Molimo Vas proverite jos jednom Vasu postu pre nego sto poslali zahtev za novi link!') }}
                    {{ __('Proverite "spam" sanduce takodje.') }}
                        <br/>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend.post') }}">
                        @csrf
                        <button type="submit" class="btn btn-link align-baseline">{{ __('Pritisnite dugme da posaljete zahtev') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
