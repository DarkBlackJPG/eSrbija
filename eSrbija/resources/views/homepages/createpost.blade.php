@extends('fixed.home')

@section('homepagecontent')

        <div class="col-md-8 col-md-offset-2 ">

            <h1>Novo obavestenje</h1>
            <hr>
            <form action="" method="POST">
                <div class="form-group has-error">
                    <h4>Kategorija <span class="requred">*</span>  </h4>
                    <br/>
                    <label for="vazno">Vazno</label>
                    <input type="radio" id="vazno" name="severity" checked>
                    &nbsp;
                    <label for="informatiovno">Informativno</label>
                    <input type="radio" id="informatiovno" name="severity">

                    <div class="col-md-12" style="padding:0;" id="categories">
                        <v-select multiple :options="categories" style="background-color: white;" v-model="selected" >
                            <template >
                                <input
                                    class="vs__search"
                                    :required="!selected"

                                >
                            </template>
                        </v-select>

                    </div>


                    <br/>
                    <table>

                        <tr>
                            <td>
                                <input type="radio" name="nivo" checked>&nbsp;Lokalni nivo &nbsp;&nbsp;
                                <input type="radio" name="nivo"> Nacionalni nivo <br/>

                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <h5>Lokaliteti za koje se obavestenje vezuje <span class="requred">*</span></h5>
                <div class="col-sm-12" style="padding: 0;" id="cities" >
                    <v-select multiple :options="cities" style="background-color: white;" v-model="selected" >
                        <template >
                            <input

                                id="citesInput"
                                class="vs__search"
                                :required="!selected"

                            >
                        </template>
                    </v-select>

                </div>
                <hr>
                <div class="form-group has-error">
                    <label for="title"><h5>Naslov<span class="require"> </span>*</h5></label>
                    <input type="text" class="form-control" name="title" />
                </div>
                <hr>
                <div class="form-group has-error">
                    <label for="description"><h5>Opis <span class="require">*</span></h5></label>
                    <textarea rows="5" class="form-control" name="description" ></textarea>
                </div>
                <hr>

                <div class="form-group ">
                    <label for="title"><h5>Link do vesti </h5></label>
                    <input type="text" class="form-control" name="title" />
                </div>
                <hr>
                <div class="form-group">
                    <p><span class="require">*</span> - obavezna polja</p>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
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
        var dozvole = [{!! $dozvole !!}];
            alert(dozvole);
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
        </script>


@endsection
