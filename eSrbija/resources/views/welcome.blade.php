<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Styles -->
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            @if(session('successModReg'))
                <script>
                    Swal.fire({
                    icon: 'success',
                    title: '{{session('successModReg')}}',
                    text: 'Potvrda registrovanja Vam je poslata na email. U roku do 3 dana cete da dobijete informaciju o statusu registracije.',
                    confirmButtonText: 'Razumem',
                    })
                </script>
            @endif
            @if(session('moderatorNotApproved'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: '{{session('moderatorNotApproved')}}',
                        text: 'Molimo Vas budite strpljivi!',
                        confirmButtonText: 'Razumem',
                    })
                </script>
            @endif


            <div class="content">
                <div class="title m-b-md highlightText">
                    e<font class="blueTextHighlight">-Srbija</font>
                </div>

                <div class="links blueTextHighlight">
                    @if (Route::has('login'))
                        <a  class="linkTransitionToRed" href="{{ route('login') }}">Login</a>
                    @endif
                    @if  (Route::has('user.register'))
                        <a class="linkTransitionToRed" href="{{ route('user.register') }}">Registracija korisnika</a>
                    @endif
                    @if (Route::has('moderator.register'))
                        <a class="linkTransitionToRed" href="{{ route('moderator.register') }}">Registracija moderatora</a>
                    @endif

                </div>
            </div>
        </div>
    </body>
</html>
