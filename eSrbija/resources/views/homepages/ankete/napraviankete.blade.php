@extends('fixed.home')

@section('homepagecontent')



        <form action="{{ route('savepoll')}}"  enctype="multipart/form-data" method="post" id="forma" name="forma">
            @csrf

            <div class="row">
                <div class="form-group pt-15">
                    <button type="button" class="btn btn-dark" onclick="check_and_send()">
                        Objavi
                    </button>
                    <button type="button" class="btn btn-dark" onclick="window.location='{{route('ankete')}}'">
                        Odustani
                    </button>
                </div>

                <hr/>
            </div>
            <div class="row">
                <div class="form-group pt-15">
                    <input type="text" name="naziv" class="form-control" placeholder="Unesite naziv ankete" size="50">
                </div>

                <hr/>
            </div>
            <div class="row">
                <table>
                    <tr>
                        <td>
                            <h3> Kategorija:</h3>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="nivo" value="lokalni" checked onclick="prikaziVue()" id="lokalni">Lokalni nivo <br/>
                            <input type="radio" name="nivo" value="nacionalni" onclick="prikaziVue()">Nacionalni nivo <br/>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row" id="citiesDiv">
                <div class="col-sm-12 p-0" >
                    <br/>
                    <h3>Lokaliteti za koje se anketa vezuje <span class="required">*</span></h3>
                </div>
                <div class="col-sm-5" style="padding: 0;" id="cities" >
                    <v-select multiple :options="cities"  style="background-color: white;" v-model="selected" >
                        <template >
                            <input

                                id="citesInput"
                                class="vs__search"
                                :required="!selected"


                            >
                        </template>
                    </v-select>
                    <input type="hidden" name="mesta[]" :value="selected">
                </div>
            </div>
            <div class="row pt-3">
                <table>
                    <tr>
                        <td>
                            <h3> Tip:</h3>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="tip" value="izbori"   >Izbori <br/>
                            <input type="radio" name="tip" value="referendum" >Referendumi <br/>
                            <input type="radio" name="tip" value="obicna" id="obicna" checked >Obična anketa <br/>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="row pt-3">
                <button type="button" class="btn btn-dark btn-sm" onclick="create_question();">
                    Dodaj pitanje</button>
            </div>
            <div class="row pt-5">
                <div class="col-8 p-0" id="pitanja">

                </div>
            </div>
        </form>




    <script>

        function prikaziVue(){
            if(document.getElementById("lokalni").checked) document.getElementById("citiesDiv").style.display="initial";
            else document.getElementById("citiesDiv").style.display="none";



        }
        Vue.component('v-select', VueSelect.VueSelect)

        var mesta =  new Vue({
            el: '#forma',
            data: {
                selected: '',
                cities: [{!! $mesta !!}]
            }
        })


        function  delete_question(id) {
            id.parentElement.parentElement.parentElement.parentElement.parentElement.removeChild(id.parentElement.parentElement.parentElement.parentElement);

        }
        function deleteAnswer(id) {
            id.parentElement.parentElement.removeChild(id.parentElement); // iz ul brisi li

        }
        var countAnswers=0;

        function create_new_answer(id) {
            countAnswers++;
            console.log(id.parentElement.parentElement.id);


            var elementListe= document.createElement("li");
            elementListe.setAttribute("class", "list-group-item");

            var odgovor = document.createElement("input");
            odgovor.setAttribute("type", "text");
            odgovor.setAttribute("name","odgovor"+ countAnswers);
            odgovor.setAttribute("placeholder", "Odgovor");
            odgovor.setAttribute("class", "odgovor");
            elementListe.appendChild(odgovor);

            var buttonClose= document.createElement("button");
            buttonClose.setAttribute("class", "close fa fa-trash ");
            buttonClose.setAttribute("onclick", "deleteAnswer(this)")
           // buttonClose.innerText="obrisi";
            elementListe.appendChild(buttonClose);

            var ul = id.parentElement.parentElement.getElementsByTagName("ul");

            console.log(ul);
            ul[0].appendChild(elementListe);
            return false; // sto ovo???

        }
        var countQuestions= 0;
        function create_question() {
            countQuestions++;
            var divPanel= document.createElement("div");
            divPanel.setAttribute("class", "card ");
            var  pitanjePolje = document.createElement("input");
            pitanjePolje.setAttribute("type","text");
            pitanjePolje.setAttribute("name","pitanje"+countQuestions);
            pitanjePolje.setAttribute("class", "pitanje");
            pitanjePolje.setAttribute("placeholder", "Unesite pitanje");

            var buttonObrisiPitanje= document.createElement("button");
            buttonObrisiPitanje.setAttribute("class", "btn  fa fa-times-circle btn-sm ml-2");
            buttonObrisiPitanje.setAttribute("type","button");
            buttonObrisiPitanje.setAttribute("onclick","delete_question(this);" );
            // buttonObrisiPitanje.setAttribute("value","Obrisi pitanje");
            buttonObrisiPitanje.setAttribute("id", "obrisiPitanje" + countQuestions);

            // buttonObrisiPitanje.innerText="Obrisi pitanje";


            var divHeading = document.createElement("div");
            divHeading.setAttribute("class", "card-header  ");
            var divRow = document.createElement("div");
            divRow.setAttribute("class", "row");
            var divCol= document.createElement("div");
            divCol.setAttribute("class", "col-6");
            var divCol2= document.createElement("div");
            divCol2.setAttribute("class", "col-6 text-right");
            divCol.appendChild(pitanjePolje);
            divCol2.appendChild(buttonObrisiPitanje);

            divRow.appendChild(divCol);
            divRow.appendChild(divCol2);
            divHeading.appendChild(divRow);


            var divBody=document.createElement("div");
            divBody.setAttribute("class", "card-body");

            var ul= document.createElement("ul");
            ul.setAttribute("class", "list-group");
            ul.setAttribute("id", "listaOdgovora" + countQuestions);

            divBody.appendChild(ul);



            var divFooter= document.createElement("div");
            divFooter.setAttribute("class", "card-footer");

            var buttonDodajOdgovor= document.createElement("button");
            buttonDodajOdgovor.setAttribute("class", "btn btn-dark btn-sm");
            buttonDodajOdgovor.setAttribute("type","button");
            buttonDodajOdgovor.setAttribute("onclick","create_new_answer(this);" );
            buttonDodajOdgovor.setAttribute("value","Dodaj odgovor");
            buttonDodajOdgovor.setAttribute("id", "dodajOdgovor" + countQuestions)
            buttonDodajOdgovor.innerText="Dodaj odgovor";
            divFooter.appendChild(buttonDodajOdgovor);


            divPanel.appendChild(divHeading);
            divPanel.appendChild(divBody);
            divPanel.appendChild(divFooter);
            var pitanja = document.getElementById("pitanja");
            pitanja.appendChild(divPanel); //dodaje pitanje u div col-md-3




            return false;

        }
        var dozvola_tip='';
        var dozvola_lokalnosti='';
        {{ ' dozvola_tip ='. $dozvola_tip}};
         {{'  dozvola_lokalnosti =' .$dozvola_lokalnosti}};
         var DOZVOLA_NACIONALNI_I_LOKALNI=2 , DOZVOLA_IZBORI_REFERENDUMI_OBICNE = 2


        function  check_and_send() {

            if(document.forma.naziv.value == ""){
                Toast.fire({
                    icon: 'warning',
                    title: 'Niste uneli naziv ankete!',
                });
                return;
            }
            else if(document.getElementById("lokalni").checked && mesta.selected =="") {

                Toast.fire({
                    icon: 'warning',
                    title: 'Nisu uneti lokaliteti!',
                });
                return;
            }
            else if(!document.getElementById("lokalni").checked && dozvola_lokalnosti!= DOZVOLA_NACIONALNI_I_LOKALNI){
                Toast.fire({
                    icon: 'warning',
                    title: 'Nemate dozvolu za pravljenje anketa nacionalnog nivoa!',
                });
                return;

            }
            else if(!document.getElementById("obicna").checked && dozvola_tip!=DOZVOLA_IZBORI_REFERENDUMI_OBICNE){
                Toast.fire({
                    icon: 'warning',
                    title: 'Nemate dozvolu za pravljenje anketa tipa referenduma ili izbora!',
                });
                return;

            }
            else {
                let pitanja = document.getElementsByClassName("pitanje");
                if(pitanja.length==0){
                    Toast.fire({
                        icon: 'warning',
                        title: 'Niste uneli nijedno pitanje!',
                    });return;}

                for(let i=0 ; i<pitanja.length; i++ ){
                    if(pitanja[i].value=="") {Toast.fire({
                        icon: 'warning',
                        title: 'Niste uneli tekstove svih pitanja!',
                    }); return;}
                    else {
                        let odgovori = pitanja[i].parentElement.parentElement.parentElement.parentElement.getElementsByTagName("input");
                        if(odgovori.length==1) {Toast.fire({
                            icon: 'warning',
                            title: 'Neka pitanja nemaju nijedan odgovor!',
                        }); return;}

                        for(let j =0 ; j< odgovori.length; j++) {
                            if(odgovori[j].class=="pitanje") { console.log("preskace pitanje") ;continue;}
                            if (odgovori[j].value=="") {Toast.fire({
                                icon: 'warning',
                                title: 'Nisu uneti tekstovi svih odgovora!',
                            }); return ;}
                        }
                    }
                }
            }
            document.forma.submit();


        }




    </script>


@endsection
