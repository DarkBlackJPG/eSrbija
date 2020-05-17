@extends('fixed.home')

@if($errors->has('title') || $errors->has('description') || $errors->has('kategorije') || $errors->has('mesta'))
    <script>
        //ispisuje poruku o nepopunjenim obaveznim poljima
        Toast.fire({
            icon: 'warning',
            title: 'Niste popunili sva obavezna polja!',
        });
    </script>
@endif

@section('homepagecontent')
        <div class="col-md-8 col-md-offset-2 ">
            <h1>Novo obaveštenje</h1>
            <hr>
            <form action="/createpost" method="POST" id="createPostForm" name="createPostForm">
                @csrf
                <div class="form-group has-error">
                    <h4>Kategorija <span class="requred">*</span>  </h4>
                    <br/>
                    <label for="vazno">Važno</label>
                    <input type="radio" id="vazno" onclick="showHideMesta()" name="severity" value="vazno">
                    &nbsp;
                    <label for="informatiovno">Informativno</label>
                    <input type="radio" id="informativno" onclick="showHideMesta()" name="severity" value="informativno" checked>

                    <div class="col-md-12" style="padding:0;">
                        <v-select multiple :options="categories" style="background-color: white;" v-model="selected" id="categories">
                            <template >
                                <input
                                    class="vs__search"
                                    :required="!selected"
                                >
                            </template>
                        </v-select>
                    </div>
                    <input type="hidden" id="kategorije" name="kategorije">
                    <input type="hidden" id="dozvole" name="dozvole">

                    <br/>
                    <table>

                        <tr>
                            <td>
                                <input type="radio" name="nivo" value="1" checked>&nbsp;Lokalni nivo &nbsp;&nbsp;
                                <input type="radio" name="nivo" value="0"> Nacionalni nivo <br/>

                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <h5>Lokaliteti na koje se obaveštenje odnosi <span class="requred">*</span></h5>
                <div class="col-sm-12" style="padding: 0;">
                    <v-select multiple :options="cities" style="background-color: white;" v-model="selected" id="cities">
                        <template >
                            <input
                                id="citesInput"
                                class="vs__search"
                                :required="!selected"
                            >
                        </template>
                    </v-select>
                </div>
                <input type="hidden" id="mesta" name="mesta">

                <hr>
                <div class="form-group has-error">
                    <label for="title"><h5>Naslov<span class="require"> </span>*</h5></label>
                    <input type="text" class="form-control" name="title" id = "title"/>
                </div>
                <hr>
                <div class="form-group has-error">
                    <label for="description"><h5>Opis <span class="require">*</span></h5></label>
                    <textarea rows="5" class="form-control" name="description" id="description"></textarea>
                </div>
                <hr>

                <div class="form-group ">
                    <label for="title"><h5>Link do vesti </h5></label>
                    <input type="text" class="form-control" name="link" id="link"/>
                </div>
                <hr>
                <div class="form-group">
                    <p><span class="require">*</span> - obavezna polja</p>
                </div>


                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="sendFormData()">
                        Objavi
                    </button>
                    <button class="btn btn-default">
                        Odustani
                    </button>
                </div>

            </form>
        </div>

        <script>
            Vue.component('v-select', VueSelect.VueSelect)
            var mesta=    new Vue({
                el: '#cities',
                data: {
                    selected: '',
                    cities: [{!! $mesta !!}]
                }
            })
            var kategorije=    new Vue({
                el: '#categories',
                data: {
                    selected: '',
                    categories: [{!! $kategorije !!}]
                }
            })

            //sakriva ili pokazuje polje za unos kategorija u zavinosti od izabranog lokaliteta
            function showHideMesta() {
                var vazno = document.getElementById("vazno");
                var selectMesto = document.getElementById("categories");
                selectMesto.style.display = vazno.checked ? "none" : "initial";
            }

            //submituje podatke iz forme serveru uz odgovarajuce provere validnosti
            function sendFormData() {
                //provera da li su sva obavezna polja popunjena
                var vazno = document.getElementById("vazno");
                var informativno = document.getElementById("informativno");
                var naslov = document.getElementById("title");
                var opis = document.getElementById("description");
                
                if(informativno.checked && kategorije.selected.length == 0) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Polje za kategorije ne sme biti prazno!',
                    }); 
                    return;
                }

                if(mesta.selected.length == 0) {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Polje za mesta na koja se obaveštenje odnosi ne sme biti prazno!',
                    });
                    return;
                }

                if(naslov.value === "") {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Naslov obaveštenja ne sme biti prazan!',
                    });
                    return;
                }

                if(opis.value === "") {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Opis obaveštenja ne sme biti prazan!',
                    });
                    return;
                }

                //provera da li korisnik ima pravo da postavi obavestenje za izabrane kategorije
                var dozvole = [{!! $dozvole !!}];
                var izabraneKategorije = document.getElementById("informativno").checked ? kategorije.selected : ["VAZNO"];
                var exit = false;

                izabraneKategorije.forEach(kategorija => {
                    if(!dozvole.includes(kategorija)) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Nemate dozvolu da postavljate u kategoriju: ' + kategorija + '!',
                        });
                        exit = true;
                    }
                });
                if(exit) return;

                if(document.getElementById("informativno").checked)
                    document.getElementById("kategorije").value = kategorije.selected;
                else
                    document.getElementById("kategorije").value = "VAZNO";
                document.getElementById("mesta").value = mesta.selected;
                document.getElementById("dozvole").value = dozvole;

                //prosledjivanje podataka
                document.createPostForm.submit();
            }
        </script>
@endsection
