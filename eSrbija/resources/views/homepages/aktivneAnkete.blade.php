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






    @if($ankete==null || count($ankete)==0 )
            <div class="row">
                <div class= " col-12 col-md-6 ankete">
         <div class="card">
             <div class="card-header text-right">
                 &nbsp;
             </div >
             <div class="card-body">
                 <h3>
                     @if(empty($tipAnkete))
                     Nema anketa raspolozivih za popunjavanje
                         @else
                     Trenutno nema aktivnih {{$tipAnkete}}
                         @endif
                 </h3>

             </div>

                    <div class="card-footer text-right">
                        &nbsp;
                    </div>
         </div>
                </div>
            </div>
         @else

            <div class = "row">
                <div class = "col-12  col-md-6">

                @foreach($ankete as $anketa)



                            <div class="card">
                                <div class="card-header visina30 inline text-right">


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
            <br><br>

            <div class="row">
                <div class="col-6 text-left col-md-3">
                    @if($page!=0)
                        <form action="{{route($route, ['page' => $page-1])}}" method="GET" >

                            <button class = " btn2  btn-outline-dark italic"> Prethodna</button>
                        </form>
                    @endif
                </div>
                <div class="col-6 col-md-3 text-right">
                    @if( $hasMore)

                        <form action="{{route($route, ['page' => $page=$page+1])}}" method="GET" >

                            <button class = " btn2  btn-outline-dark italic">Sledeca</button>
                        </form>
                    @endif
                </div>
            </div>
                @endif






@endsection
