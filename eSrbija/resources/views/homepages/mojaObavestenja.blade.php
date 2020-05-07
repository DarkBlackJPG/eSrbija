@extends('fixed.home')
@section('homepagecontent')


@if(Session::has('info'))
    <script>
    Toast.fire({
            icon: 'success',
            title: 'Obavestenje uspesno obrisano',
            timer: 2000,
            timerProgressBar: true
        })
    </script>
    {{Session::forget('info') }}
    @endif


@if(count($mojaObavestenja) == 0)
    <div class = "row justify-content-center align-items-center" >
        <div class="col-md-12 text-center">
           <div class="card">
               @if($isAdmin)
                    <h2>U sistemu nema obavestenja</h2>
                @else
                    <h2>Nemate nijedno obavestenje</h2>
               @endif
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
                            @foreach($mojeObavestenje->pripadaKategorijama as $kategorija)
                            <span class="cat">|&nbsp;{{$kategorija->naziv}}</span>
                            @endforeach
                            |
                            <h3><a href="#" target="_blank">{{ $mojeObavestenje->naslov }}</a></h3>
                            <p>{{ $mojeObavestenje->opis }}</p>                         
                        </div>
                        <div class = "deleteBtn">
                            <form action="{{ route('obrisiObavestenje', ['id'=> $mojeObavestenje->id]) }}" method="post">
                                @csrf
                                <input type="submit" class = "btn btn-dark" value="Obrisi">
                            </form>
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
