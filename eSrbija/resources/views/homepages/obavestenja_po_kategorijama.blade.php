@extends('fixed.home')
@section('homepagecontent')
  

<div class="row">
    <div class="col text-center" >
        <h1> {{ $imeKategorije }} </h1>
    </div>
</div>
@if(count($mojaObavestenja) == 0)
    <div class = "row justify-content-center align-items-center" >
        <div class="col-md-12 text-center">
           <div class="card">
                <h2>Izabrana kategorija nema nijedno obavestenje</h2>
            </div>
        </div>
    </div>
@else   
    <div class = "row justify-content-center align-items-center" >
        @foreach($mojaObavestenja as $mojeObavestenje)
        
            <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-6"> 
                <div class="blog-grids-moderator">
                    <div class="grid">
                        <div class="entry-body text-center">
                            <span class="cat">{{ $imeKategorije }}</span>
                            <h3><a href="#" target="_blank">{{ $mojeObavestenje->naslov }}</a></h3>
                            <p>{{ $mojeObavestenje->opis }}</p>                              
                        </div>
                    </div>
                </div>
            </div>
    
        @endforeach
    </div>
@endif

<div class="row">
    <div class="col-sm-12">
        {{ $mojaObavestenja->links() }}
    </div>
</div>
    @endsection
