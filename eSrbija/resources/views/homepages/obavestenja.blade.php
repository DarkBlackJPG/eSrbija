@extends('fixed.home')

@section('homepagecontent')

@if(session('obavestenje'))
    <script>
        //ispisuje poruku o uspesno kreiranom obavestenju
        Toast.fire({
            icon: 'success',
            title: '{{session('obavestenje')}}',
        });
    </script>
@endif

@if(session('dozvole'))
    <script>
        //ispisuje poruku o nedozvoljenom pokusaju postavljanja obavestenja
        Toast.fire({
            icon: 'warning',
            title: '{{session('dozvole')}}',
        });
    </script>
@endif

@if(session('tokenVerifiedSuccessfully'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{session('tokenVerifiedSuccessfully')}}',
            text: 'Uspesno ste potvrdili Vasu elektronsku postu!',
            confirmButtonText: 'Razumem',
        })
    </script>
@endif

@if(session('tokenInvalid'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{session('tokenInvalid')}}',
            text: 'Vas link je istekao',
            confirmButtonText: 'Razumem',
        })
    </script>
@endif
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" style="width:100%; height: 200px !important;">
                @foreach($vaznaObavestenja as $obavestenje)
                    <div class="carousel-item @if($obavestenje == $vaznaObavestenja->first()) {{'active'}} @endif carusell">
                        <div class="offset-2 col-sm-8 carusell">
                            <h1>{{$obavestenje->naslov}}</h1>
                            <hr/>
                            <p>{{$obavestenje->opis}}</p>
                            <hr/>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="col col-xs-12">
            <div class="blog-grids">
                <div class="grid">

                    <div class="entry-body">
                        <span class="cat">Sport</span>
                        <h3><a href="#" target="_blank">Kosarka</a></h3>
                        <p>Kosarkaski savez Srbije donosi odluku o ukidanju 3. srpske lige</p>
                        <div class="read-more-date">
                            <a href="#" target="_blank">Read More..</a>
                            <span class="date">3 Hours ago</span>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <div class="entry-body">
                        <span class="cat">Finansije</span>
                        <h3><a href="#" target="_blank">Odluka o kupoprodaji Komercijalne banke</a></h3>
                        <p>Министар финансија у Влади Републике Србије Синиша Мали, председник Извршног одбора Нове Љубљанске банке д.д (НЛБ) Блаж Бродњак и члан Извршног одбора те банке Арчибалд Кремсер потписали су данас у Министарству финансија Уговор о купопродаји акција, у вези са 83,23% обичних акција Комерцијалне банке а.д Београд. Потписивањем овог уговора, банка ће добити новог стратешког партнера, који ће након завршетка трансакције преузети и управљање банком.</p>
                        <div class="read-more-date">
                            <a href="#" target="_blank">Read More..</a>
                            <span class="date">3 Hours ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
