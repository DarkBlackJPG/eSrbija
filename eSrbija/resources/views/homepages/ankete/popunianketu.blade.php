@extends('fixed.home')

@section('homepagecontent')
    <!-- Filip Carevic 0065/2017-->

        <form action="{{route('save_answers',['id'=> $anketa->id])}}" name="forma" method="post" enctype="multipart/form-data">
            @csrf
@foreach($anketa->pitanja as $pitanje)
        <div class="row p-3 pitanje" >
                <div class="col-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <span class="glyphicon glyphicon-arrow-right"></span> {{$pitanje->tekst}}?
                            </h3>
                        </div>


                        @foreach($pitanje->odgovori as $odgovor)
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="{{$pitanje->id}}" value="{{$odgovor->id}}">
                                        </label>
                                        {{$odgovor->tekst}}
                                    </div>
                                </li>

                            </ul>
                        </div>
                        @endforeach
                    </div>

                </div>
        </div>
@endforeach

                        <div class="row p-3">
                            <div class="col-3">
                            <input type="button"  onclick="check_and_send()" class="btn btn-dark btn-sm" value="Potvrdi">

                            <button type="button"   class="btn btn-dark btn-sm" onclick='window.location="{{route('ankete')}}"'>Odustani</button></div>
                        </div>
                        </form>










    <script >

        function  check_and_send() {

           let pitanja  = document.getElementsByClassName("pitanje");
           for(let i =0 ; i< pitanja.length; i++){
               let flag = false;
               let odgovori = pitanja[i].getElementsByTagName("input");
                for(let j=0; j<odgovori.length; j++){
                    if(odgovori[j].checked)flag=true;
                }
                if(!flag) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Niste odgovorili na sva pitanja',
                    });
                    return;}
           }


            document.forma.submit();
        }


    </script>


@endsection
