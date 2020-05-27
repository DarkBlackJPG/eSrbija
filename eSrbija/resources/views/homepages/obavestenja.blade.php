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
        @if($vaznaObavestenja != null && count($vaznaObavestenja) > 0)
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
        @endif

        
        @if($ostalaObavestenja != null && $ostalaObavestenja->count() > 0)
            <div class = "row justify-content-center align-items-center" >
            @foreach($ostalaObavestenja as $obavestenje)
                <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-6"> 
                    <div class="blog-grids-moderator">
                        <div class="grid">
                            <div class="entry-body text-center">
                                @foreach($obavestenje->pripadaKategorijama as $kategorija)
                                    <span class="cat"> 
                                        @if($kategorija != $obavestenje->pripadaKategorijama()->first()) {{'|'}} @endif 
                                        &nbsp;
                                        <a href="{{route('obavestenja_za_kategoriju',$kategorija->id)}}">{{$kategorija->naziv}}</a>
                                    </span>
                                @endforeach
                                <h3>{{ $obavestenje->naslov }}</h3>
                                <p>{{ $obavestenje->opis }}</p>
                                <span class="date">{{$obavestenje->created_at->diffForHumans()}}</span>
                            </div>
                            @if($obavestenje->link != null)
                                <div class="read-more-date">
                                    <a href="{{$obavestenje->link}}" target="_blank">Read More...</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{ $ostalaObavestenja->links() }}
                </div>
            </div>
        @else
            <h2>Jos uvek nema obavestenja.</h2>
        @endif
@endsection
