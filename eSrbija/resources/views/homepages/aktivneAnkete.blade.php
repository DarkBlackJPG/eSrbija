@extends('fixed.home')

@section('homepagecontent')

    @if(session('poruka'))

        <script>
            Toast.fire({
                icon: '{{session('icon')}}',
                title: '{{session('poruka')}}',
            })
        </script>

    @endif



    <div class = "container">


    @if($ankete==null || count($ankete)==0 )
            <div class="row">
                <div class= " col-sm-6 ankete">
         <div class="card">
             <div class="card-header text-right">
                 &nbsp;
             </div >
             <div class="card-body">
                 <h3>Nema anketa raspolozivih za popunjavanje</h3>

             </div>

                    <div class="card-footer text-right">
                        &nbsp;
                    </div>
         </div>
                </div>
            </div>
         @else

            <div class = "row">
                <div class = "col-6">

                @foreach($ankete as $anketa)



                            <div class="card">
                                <div class="card-header inline text-right">


                                            <p class="italic">  <i  class="fa fa-clock-o"></i><i> &nbsp; {{$anketa->created_at}} </i></p>
                                </div>
                                    <div class="card-body text-left">
                                        <h3>{{$anketa->naziv}}</h3>
                                    </div>
                                    <div class=" card-footer card-footer2 text-right">
                                        <form action="{{route('anketeid', ['id' => $anketa->id])}}" method="GET" >

                                            <button class = " btn2  btn-outline-dark italic"> Popuni anketu</button>
                                        </form>

                                    </div>



                            </div>




               @endforeach
                </div>
            </div>
                @endif


    </div>


@endsection
