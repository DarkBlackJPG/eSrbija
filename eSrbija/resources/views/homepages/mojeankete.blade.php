@extends('fixed.home')
@section('homepagecontent')

    <div class = "container">

        <div class="row">

            <div class= " col-12 ankete">
                @if($anketeMoje == null || count($anketeMoje)==0) <h3>Nemate nijednu objavljenu anketu</h3>
            @else
                @foreach($anketeMoje as $anketa)
                <div class="card">
                    <div class = "row">
                        <div class = "col-8">
                            <h3>{{$anketa->naziv}}</h3>
                            <h5>{{$anketa->created_at}}</h5>

                        </div>
                        <div class = "col-4 align-self-center ">

                            <button class = "btn"> <a href = "{{route('statistikaankete', ['id'=> $anketa->id])}}">statistika</a></button>


                        @if($anketa->obrisanoFlag==false)


                                <form action="{{route('obrisianketu', ['id' => $anketa->id])}}" method="post">
                                    @csrf
                                    <button class = "btn mt-1"> Obrisi</button>
                                </form>

                        @endif
                            @if($anketa->isActive)


                                <form action="{{route('zatvorianketu', ['id' => $anketa->id])}}" method="post">
                                    @csrf
                                <button class = "btn mt-1"> Zatvori </button>
                                </form>

                            @endif
                        </div>

                    </div>
                </div>
                    @endforeach
                    @endif


            </div>
        </div>
    </div>



@endsection
