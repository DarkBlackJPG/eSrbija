@extends('fixed.home')

@section('homepagecontent')


        <div class="container" >

                <form action="{{route('savepoll')}}"  enctype="multipart/form-data" method="post" id="forma">
                    @csrf

            <div class="row">
                    <div class="form-group pt-15">
                        <button type="submit" class="btn btn-primary">
                            Objavi
                        </button>
                        <button type="button" class="btn btn-default">
                            Odustani
                        </button>
                    </div>

                <hr/>
            </div>
                    <div class="row">
                        <div class="form-group pt-15">
                            <input type="text" name="naziv" placeholder="Unesite naziv ankete" size="50">
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

                                <input type="radio" name="nivo" value="lokalni">Lokalni nivo <br/>
                                <input type="radio" name="nivo" value="nacionalni">Nacionalni nivo <br/>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12" >
                    <br/>
                    <h5>Lokaliteti za koje se anketa vezuje <span class="required">*</span></h5>

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
    <div class="row p-3">
        <button type="button" class="btn btn-primary btn-sm" onclick="create_question();">
            Dodaj pitanje</button>
    </div>
            <div class="row pt-5">


                <div class="col-md-4 offset-2" id="pitanja">

                     </div>
        </div>

                </form>

            </div>
        <script>
            Vue.component('v-select', VueSelect.VueSelect)

            new Vue({
                el: '#forma',
                data: {
                    selected: '',
                cities: [{!! $mesta !!}]
                    //['Subotica', 'Beograd', 'Cacak', 'Novi Sad']
                }
            })

        </script>

<script type="text/javascript" >
    function deleteAnswer(id) {
        id.parentElement.parentElement.removeChild(id.parentElement); // iz ul brisi li

    }
    var countAnswers=0;

    function create_new_answer(id) {
        countAnswers++;
        console.log(id.id);


        var elementListe= document.createElement("li");
        elementListe.setAttribute("class", "list-group-item");

        var odgovor = document.createElement("input");
        odgovor.setAttribute("type", "text");
        odgovor.setAttribute("name","odgovor"+ countAnswers);
        odgovor.setAttribute("placeholder", "Odgovor");
        elementListe.appendChild(odgovor);

        var buttonClose= document.createElement("button");
        buttonClose.setAttribute("class", "close");
        buttonClose.setAttribute("onclick", "deleteAnswer(this)")
        buttonClose.innerText="obrisi";
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
        divPanel.setAttribute("class", "panel pt-4");
    var  pitanjePolje = document.createElement("input");
    pitanjePolje.setAttribute("type","text");
    pitanjePolje.setAttribute("name","pitanje"+countQuestions);
    pitanjePolje.setAttribute("placeholder", "Unesite pitanje");


    var divHeading = document.createElement("div");
      divHeading.setAttribute("class", "panel-heading p-3");

   divHeading.appendChild(pitanjePolje);


     var divBody=document.createElement("div");
      divBody.setAttribute("class", "panel-body");

      var ul= document.createElement("ul");
      ul.setAttribute("class", "list-group");
      ul.setAttribute("id", "listaOdgovora" + countQuestions);

      divBody.appendChild(ul);



      var divFooter= document.createElement("div");
       divFooter.setAttribute("class", "panel-footer");

       var buttonDodajOdgovor= document.createElement("button");
       buttonDodajOdgovor.setAttribute("class", "btn btn-primary btn-sm");
       buttonDodajOdgovor.setAttribute("type","button");
       buttonDodajOdgovor.setAttribute("onclick","create_new_answer(this);" );
    buttonDodajOdgovor.setAttribute("value","Dodaj odgovor");
    buttonDodajOdgovor.setAttribute("id", "dodajOdgovor" + countQuestions)
      buttonDodajOdgovor.innerText="dodaj odgovor";
       divFooter.appendChild(buttonDodajOdgovor);

       divPanel.appendChild(divHeading);
       divPanel.appendChild(divBody);
       divPanel.appendChild(divFooter);
        var pitanja = document.getElementById("pitanja");
        pitanja.appendChild(divPanel); //dodaje pitanje u div col-md-3




       return false;

    }







</script>


@endsection
