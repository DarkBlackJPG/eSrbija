@extends('fixed.home')
@section('homepagecontent')
    <div class='statistika'>


    @foreach ($pitanja as $pitanje)
        <div class="row">
            <div class=" col-sm-8">
                <dl>
                    <dt>
                       {{$pitanje->tekst}}
                    </dt>
                
                    @foreach ($pitanje->odgovori as $ponudjeniOdgovor)
                        <dd class="percentage percentage-{{round(count($ponudjeniOdgovor->korisnici)/$brojOdgovora[$pitanje->id] * 100)}}"><span class="text">{{$ponudjeniOdgovor->tekst}}: {{ round(count($ponudjeniOdgovor->korisnici)/$brojOdgovora[$pitanje->id] * 100) }}%</span></dd>             
                               
                    @endforeach
                </dl>
            </div>
        </div>
    @endforeach
<div class="row">
    <div class="col-sm-8">
        {{ $pitanja->links() }}
    </div>
</div>
   
@endsection
