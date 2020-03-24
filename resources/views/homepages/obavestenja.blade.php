@extends('fixed.home')

@section('homepagecontent')

        {{auth()->user()}}
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner " style=" width:100%; height: 200px !important;">
                <div class="carousel-item active carusell">
                    <div class="offset-2 col-sm-8 carusell ">
                        <h1>EPIDEMIJA KORONA VIRUSA</h1>
                        <hr/>
                        <p>Zbog epidemije smrtonosnog virusa, proglasava se vanredno stanje na teritoriji Republike Srbije</p>
                        <hr/>
                    </div>

                </div>
                <div class="carousel-item carusell">
                    <div class="offset-2 col-sm-8 carusell ">
                        <h1>Opasnost od poplava</h1>
                        <hr/>
                        <p>Zbog previsokog vodostaja reke Zapadne Morave proglasava se vanredno stanje na teritoriji grada Cacka i okolnih opstina</p>
                        <hr/>
                    </div>
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>2</a>
        </div>

        <div class="col col-xs-12">
            <div class="blog-grids">
                <div class="grid">

                    <div class="entry-body">
                        <span class="cat">Sport</span>
                        <h3><a href="#" target="_blank">Kosarka</a></h3>
                        <p>Kosarkaski savez Srbije donosi odluku o ukidanju 3. srpske lige</p>
                        <div class="read-more-date">
                            <a href="#" target="_blank">Read More..</a>
                            <span class="date">3 Hours ago</span>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <div class="entry-body">
                        <span class="cat">Finansije</span>
                        <h3><a href="#" target="_blank">Odluka o kupoprodaji Komercijalne banke</a></h3>
                        <p>Министар финансија у Влади Републике Србије Синиша Мали, председник Извршног одбора Нове Љубљанске банке д.д (НЛБ) Блаж Бродњак и члан Извршног одбора те банке Арчибалд Кремсер потписали су данас у Министарству финансија Уговор о купопродаји акција, у вези са 83,23% обичних акција Комерцијалне банке а.д Београд. Потписивањем овог уговора, банка ће добити новог стратешког партнера, који ће након завршетка трансакције преузети и управљање банком.</p>
                        <div class="read-more-date">
                            <a href="#" target="_blank">Read More..</a>
                            <span class="date">3 Hours ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
