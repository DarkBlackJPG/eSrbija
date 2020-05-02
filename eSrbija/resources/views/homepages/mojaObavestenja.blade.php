@extends('fixed.home')
@section('homepagecontent')
  
<div class = "row justify-content-center" >
    @foreach($mojaObavestenja as $mojeObavestenje)
    
          <div class = "col-xs-12 col-sm-12 col-md-6 col-lg-6"> 
            <div class="blog-grids-moderator">
                <div class="grid">
                    <div class="entry-body text-center">
                        <span class="cat">Finansije</span>
                        <h3><a href="#" target="_blank">{{ $mojeObavestenje->naslov }}</a></h3>
                        <p>{{ $mojeObavestenje->opis }}</p>                              
                    </div>
                </div>
            </div>
        </div>
   
    @endforeach
</div>
<div class="row">
    <div class="col-sm-12">
        {{ $mojaObavestenja->links() }}
    </div>
</div>
    @endsection
