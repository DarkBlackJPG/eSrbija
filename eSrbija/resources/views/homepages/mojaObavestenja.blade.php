@extends('fixed.home')
@section('homepagecontent')
  

    @foreach($mojaObavestenja as $mojeObavestenje)

        <p>{{ $mojeObavestenje->naslov }}</p>
        <p>{{ $mojeObavestenje->opis }}</p>


    @endforeach

    @endsection
