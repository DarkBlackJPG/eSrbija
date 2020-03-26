@extends('fixed.home')

@section('homepagecontent')
    <div class = "container">


        <form action="{{route('save_answers',['id'=> $anketa->id])}}" method="post" enctype="multipart/form-data">
            @csrf
@foreach($anketa->pitanja as $pitanje)
        <div class="row p-3">
                <div class="col-md-3">
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
                            <input type="submit" class="btn btn-primary btn-sm" value="Potvrdi">

                            <button href="#">Odustani</button></div>
                        </div>
                        </form>







        </form>
        </div>



@endsection
