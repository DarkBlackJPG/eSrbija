@extends('fixed.home')

@section('homepagecontent')
    <div class = "container">
        <div class="row">
            <div class= " col-sm-8 ankete">

    @if($ankete==null || count($ankete)==0 )

         <div class="card">
             <div class="row">
                 <div class="col-8">
                     <h3>Nema anketa raspolozivih za popunjavanje</h3>
                 </div>
             </div>
         </div>
         @else



                @foreach($ankete as $anketa)

                <div class="card">
                    <div class = "row">
                        <div class = "col-sm-8">
                            <h2>{{$anketa->naziv}}</h2>
                            <h5>{{$anketa->created_at}}</h5>

                        </div>
                        <div class = "offset-sm-2 align-self-right align-self-bottom">
                            <form action="{{route('anketeid', ['id' => $anketa->id])}}" method="GET" >

                            <button class = "btn"> PopuniAnketu</button>
                            </form>

                        </div>
                    </div>
                </div>
               @endforeach
                @endif

            </div>
        </div>
    </div>


@endsection
