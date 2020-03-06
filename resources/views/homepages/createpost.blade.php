@extends('fixed.home')

@section('homepagecontent')
        <div class="col-md-8 col-md-offset-2">

            <h1>Novo obavestenje</h1>

            <form action="" method="POST">

                <div class="form-group has-error pt-5">
                    <label for="slug">Kategorija  </label>
                    <br/>
                    <label for="vazno">Vazno</label>
                    <input type="radio" id="vazno" name="severity" checked>
                    &nbsp;
                    <label for="informatiovno">Informativno</label>
                    <input type="radio" id="informatiovno" name="severity">

                    <div id="categories" >

                        <v-select multiple :options="categories"  v-model="selected" >
                            <template  #search="{attributes, events}">
                                <input
                                    placeholder="Odaberi informativnu kategoriju"
                                    id="infoKat"
                                    class="vs__search"
                                    :required="!selected"
                                    v-bind="attributes"
                                    v-on="events"
                                >
                            </template>
                        </v-select>
                        <input type="hidden" name="kategorije"  id="kategorije" :value="selected{{old('kategorije')}}">
                    </div>


                    @error('kategorije')
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                    <br/>
                    <table>

                        <tr>
                            <td>
                                <form>
                                    <input type="radio" name="nivo">Lokalni nivo <br/>
                                    <input type="radio" name="nivo">Nacionalni nivo <br/>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="form-group has-error">
                    <label for="title">Naslov <span class="require">*</span></label>
                    <input type="text" class="form-control" name="title" />
                </div>

                <div class="form-group has-error">
                    <label for="description">Opis</label> <span class="require">*</span>
                    <textarea rows="5" class="form-control" name="description" ></textarea>
                </div>


                <div class="form-group ">
                    <label for="title">Link do vesti </label>
                    <input type="text" class="form-control" name="title" />
                </div>
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

            new Vue({
                el: '#selectMunicipalityContainer',
                data: {
                    selected: '',
                    muncipalities: ['Subotica', 'Beograd', 'Novi Sad']
                }
            })
            new Vue({
                el: '#categories',
                data: {
                    selected: '',
                    categories: [ 'Sport', 'Finansije','Kultura','Energetika']
                }
            })
        </script>
@endsection
