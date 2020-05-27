@extends('fixed.home')

<script>
    $(document).ready(function() {
        $("#naslov").attr('value') = '{{old('naslov')}}';
    });
    function returnToTop() {
        document.location.href = "#topOfPage";
    }
    function returnToHomepage() {
        document.location.href = "{{route('home')}}";
    }
</script>

@section('homepagecontent')

    @if($obavestenja != null && $obavestenja->count() > 0)
        <div class = "row justify-content-center align-items-center">
        @foreach($obavestenja as $obavestenje)
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
        <div class = "row justify-content-center align-items-center">
            <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="returnToTop()">
                    Nazad na vrh
                </button>
                <button class="btn btn-secondary" onclick="returnToHomepage()">
                    Nazad na pocetnu stranicu
                </button>
            </div>
        </div>
    @else
        <div class = "row justify-content-center align-items-center" >
            <h2>Nema obavestenja sa zadatim naslovom ili naslovom slicnim njemu.</h2>
        </div>
    @endif

@endsection