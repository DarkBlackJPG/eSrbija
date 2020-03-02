@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        {{ __('Ministarstvo unutrasnjih poslova i privrede') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row col-md-12">
                               <label class="col-md-4">
                                   Naziv:
                               </label>
                                <label class="offset-1 col-md-7">
                                    Ministarstvo unutrasnjih poslova i privrede
                                </label>
                            </div>
                            <hr/>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Opstina:
                                </label>
                                <label class="offset-1 col-md-7">
                                    Rakovica
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Adresa:
                                </label>
                                <label class="offset-1 col-md-7">
                                    Bulevar kralja Karnevala 22/2
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    PIB:
                                </label>
                                <label class="offset-1 col-md-7">
                                   72617
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Maticni broj:
                                </label>
                                <label class="offset-1 col-md-7">
                                    82991829
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Kategorije za objave:
                                </label>
                                <div class=" categories offset-1 col-md-7">
                                    <v-select multiple :options="categories"  v-model="selected" >
                                        <template  #search="{attributes, events}">
                                            <input
                                                class="vs__search"
                                                :required="!selected"
                                                v-bind="attributes"
                                                v-on="events"

                                                value="{{old('prebivaliste')}}"
                                            >
                                        </template>
                                    </v-select>
                                    <input type="hidden" name="opstina"  id="opstina" :value="selected{{old('prebivaliste')}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <div class="offset-md-4">
                                    <button formaction="#" type="submit" class="btn btn-danger"><i class="fas fa-times">&nbsp;Odbij</i></button>
                                    <button formaction="#" class="btn btn-success"><i class="fas fa-check">&nbsp;Odobri</i></button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
                <div class="row">&nbsp;</div>
                <div class="card">
                    <div class="card-header">
                        {{ __('Ministarstvo unutrasnjih poslova i privrede') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Naziv:
                                </label>
                                <label class="offset-1 col-md-7">
                                    Ministarstvo unutrasnjih poslova i privrede
                                </label>
                            </div>
                            <hr/>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Opstina:
                                </label>
                                <label class="offset-1 col-md-7">
                                    Rakovica
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Adresa:
                                </label>
                                <label class="offset-1 col-md-7">
                                    Bulevar kralja Karnevala 22/2
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    PIB:
                                </label>
                                <label class="offset-1 col-md-7">
                                    72617
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Maticni broj:
                                </label>
                                <label class="offset-1 col-md-7">
                                    82991829
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Kategorije za objave:
                                </label>
                                <div class=" categories offset-1 col-md-7">
                                    <v-select multiple :options="categories"  v-model="selected" >
                                        <template  #search="{attributes, events}">
                                            <input
                                                class="vs__search"
                                                :required="!selected"
                                                v-bind="attributes"
                                                v-on="events"

                                                value="{{old('prebivaliste')}}"
                                            >
                                        </template>
                                    </v-select>
                                    <input type="hidden" name="opstina"  id="opstina" :value="selected{{old('prebivaliste')}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <div class="offset-md-4">
                                    <button formaction="#" type="submit" class="btn btn-danger"><i class="fas fa-times">&nbsp;Odbij</i></button>
                                    <button formaction="#" class="btn btn-success"><i class="fas fa-check">&nbsp;Odobri</i></button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
                <div class="row">&nbsp;</div>
                <div class="card">
                    <div class="card-header">
                        {{ __('Ministarstvo unutrasnjih poslova i privrede') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Naziv:
                                </label>
                                <label class="offset-1 col-md-7">
                                    Ministarstvo unutrasnjih poslova i privrede
                                </label>
                            </div>
                            <hr/>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Opstina:
                                </label>
                                <label class="offset-1 col-md-7">
                                    Rakovica
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Adresa:
                                </label>
                                <label class="offset-1 col-md-7">
                                    Bulevar kralja Karnevala 22/2
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    PIB:
                                </label>
                                <label class="offset-1 col-md-7">
                                    72617
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Maticni broj:
                                </label>
                                <label class="offset-1 col-md-7">
                                    82991829
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Kategorije za objave:
                                </label>
                                <div class=" categories offset-1 col-md-7">
                                    <v-select multiple :options="categories"  v-model="selected" >
                                        <template  #search="{attributes, events}">
                                            <input
                                                class="vs__search"
                                                :required="!selected"
                                                v-bind="attributes"
                                                v-on="events"

                                                value="{{old('prebivaliste')}}"
                                            >
                                        </template>
                                    </v-select>
                                    <input type="hidden" name="opstina"  id="opstina" :value="selected{{old('prebivaliste')}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <div class="offset-md-4">
                                    <button formaction="#" type="submit" class="btn btn-danger"><i class="fas fa-times">&nbsp;Odbij</i></button>
                                    <button formaction="#" class="btn btn-success"><i class="fas fa-check">&nbsp;Odobri</i></button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        Vue.component('v-select', VueSelect.VueSelect)
        let elements = document.getElementsByClassName('categories')
        for(let el of elements){
            new Vue({
                el:el,
                data: {
                    selected: '',
                    categories: ['Vazno', 'Onako', 'Slabo']
                }
            })
        }



    </script>
@endsection
