@extends('fixed.home')
@section('homepagecontent')
    <!-- Filip Carevic 0065/2017-->

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
                    <div class="card-footer text-right">
                        &nbsp;
                    </div>
                    <div class="card-body">
                    <h2>Nemate nijednu objavljenu anketu</h2>

                    </div>
                    <div class="card-footer text-right">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class= "col-lg-12 ankete">

                @foreach($anketeMoje as $anketa)
                    <div class = "row justify-content-center ">
                        <div class = "col-12  col-md-10">
                <div class="card">

                            <div class="card-header visina30 inline text-right">
                             <div class="row">
                                 <div class="col-6 text-left">
                                 <p class="italic">  <i  class="fa fa-clock-o"></i> &nbsp; {{$anketa->created_at}}</p>
                             </div>
                                <div class="col-6 text-right">

                            <form action="{{route('statistikaankete', ['id'=> $anketa->id])}}" method="get">
                                @csrf
                                <button class = "fa fa-chart-bar submitDugme" > </button>
                            </form>
                        @if($anketa->obrisanoFlag==false)


                                <form action="{{route('obrisianketu', ['id' => $anketa->id])}}" method="post">
                                    @csrf
                                    <button class = "fa fa-trash-alt submitDugme" > </button>
                                </form>

                        @endif
                            @if($anketa->isActive)


                                <form action="{{route('zatvorianketu', ['id' => $anketa->id])}}" method="post">
                                    @csrf
                                    <button class = "fa fa-times-circle submitDugme" > </button>
                                </form>

                            @endif
                                </div>
                            </div>
                    </div>

                        <div class="card-body text-left">
                            <h3>{{$anketa->naziv}}</h3>
                        </div>
                        <div class="card-footer visina15 text-right">
                                 &nbsp;
                        </div>
                    </div>
                    </div>

                </div>
                 @endforeach
            </div>
        </div>

        <br><br>

        <div class="row">
            <div class="col-6 text-left col-md-4">
                @if($page!=0)
                    <form action="{{route('mojeankete', ['page' => $page-1])}}" method="GET" >

                        <button class = " btn2  btn-outline-dark italic"> Prethodna</button>
                    </form>
                @endif
            </div>
            <div class="col-6 col-md-4 text-right">
                @if( $hasMore)

                    <form action="{{route('mojeankete', ['page' => $page=$page+1])}}" method="GET" >

                        <button class = " btn2  btn-outline-dark italic">Sledeca</button>
                    </form>
                @endif
            </div>
        </div>
    @endif
@endsection
