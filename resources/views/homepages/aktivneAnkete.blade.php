@extends('fixed.home')

@section('homepagecontent')
    <div class = "container">
        <div class="row">
            <div class= " col-sm-8 ankete">
    @if(request('ankete')==null)
         <div class="card">
             <div class="row">
                 <div class="col-8">
                     <h1>Nema aktivnijh anketa</h1>
                 </div>
             </div>
         </div>
         @else





                <div class="card">
                    <div class = "row">
                        <div class = "col-sm-8">
                            <h2>Anketa 1</h2>
                            <h5>Title description, Dec 7, 2017</h5>
                            <p>Anketu je popunilo..</p>
                        </div>
                        <div class = "offset-sm-2 align-self-center">
                            <button class = "btn"> <a href = "{{route('statistikaankete')}}">statistika</a></button>
                            <button class = "btn"> <a href = "#">obrisi</a></button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
 @endif


@endsection
