@extends('fixed.home')
@section('homepagecontent')
  
    @if(Session::has('info'))
    <script>
    Swal.fire({
            icon: 'info',
            title: 'Statistika',
            text: 'Za datu anketu nema statistike',
            timer: 2000,
            timerProgressBar: true
        })
    </script>
    {{Session::forget('info') }}
    @endif




    @if(session('poruka'))

        <script>
            Toast.fire({
                icon: '{{session('icon')}}',
                title: '{{session('poruka')}}',
            })
        </script>

    @endif


   <?php
    /*@if(isset($poruka))

        <script>
            Toast.fire({
                icon: '{{$poruka}}',
                title: '{{$icon}}',
            })
        </script>*/

    ?>

    @if($anketeMoje == null || count($anketeMoje)==0)
        <div class="row justify-content-center align-items-center ">
            <div class= "col-lg-12 ankete text-center">
                <div class="card">
                    <h2>Nemate nijednu objavljenu anketu</h2>
                </div>
            </div>
        </div>
    @else
        <div class="row align-items-center">
            <div class= "col-lg-12 ankete">
               
                @foreach($anketeMoje as $anketa)
                <div class="card">
                    <div class = "row align-items-center">
                        <div class = "col-8">
                            <h3>{{$anketa->naziv}}</h3>
                            <h5>{{$anketa->created_at}}</h5>

                        </div>
                        <div class = "col-4 align-self-center text-center ">
                            <form action="{{route('statistikaankete', ['id'=> $anketa->id])}}" method="get">
                                @csrf
                                <button class = "btn mt-1">Statistika</button>
                            </form>
                        @if($anketa->obrisanoFlag==false)


                                <form action="{{route('obrisianketu', ['id' => $anketa->id])}}" method="post">
                                    @csrf
                                    <button class = "btn mt-1"> &nbsp;&nbsp; Obrisi &nbsp;&nbsp;</button>
                                </form>

                        @endif
                            @if($anketa->isActive)


                                <form action="{{route('zatvorianketu', ['id' => $anketa->id])}}" method="post">
                                    @csrf
                                <button class = "btn mt-1">&nbsp; Zatvori&nbsp;&nbsp; </button>
                                </form>

                            @endif
                        </div>

                    </div>
                </div>
                 @endforeach
            </div>
        </div>
    @endif
@endsection
