@extends('layouts.guest')

@section('content')
<link rel="stylesheet" href="{{asset('css/authentication.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card no-padding">
                <div class="card-header"><h3>{{ __('Forma za prijavu moderatora') }} </h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('moderator.register.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="naziv" class="col-md-4 col-form-label text-md-right">{{ __('Naziv')}}</label>

                            <div class="col-md-6">
                                <input id="naziv" type="text" class="form-control @error('naziv') is-invalid @enderror" name="naziv" value="{{ old('naziv') }}" required autocomplete="naziv" autofocus>
                                @error('naziv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="opstina" class="col-md-4 col-form-label text-md-right">{{ __('Opstina poslovanja') }}</label>

                            <div class="col-md-6">
                                <div id="selectMunicipalityContainer" >
                                    <v-select :options="muncipalities"  v-model="selected" >
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
                                    <input type="hidden" name="opstina"  id="opstina" :value="selected">
                                </div>


                                @error('opstina')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lokalnost" class="col-md-4 col-form-label text-md-right">{{ __('Maksimalna lokalnost objava') }}</label>

                            <div class="col-md-6">
                                <input type="radio" name="lokalnost" value="1" checked> Lokalno<br>
                                <input type="radio" name="lokalnost" value="2"> Lokalno i nacionalno<br>
                                @error('lokalnost')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ankete" class="col-md-4 col-form-label text-md-right">{{ __('Tipovi anketa') }}</label>

                            <div class="col-md-6">
                                <input type="radio" name="ankete" value="1" checked> Obicne<br>
                                <input type="radio" name="ankete" value="2"> Svi tipovi<br>
                                @error('ankete')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="adresa" class="col-md-4 col-form-label text-md-right">{{ __('Adresa') }}</label>

                            <div class="col-md-6">
                                <input id="adresa" type="text" class="form-control @error('adresa') is-invalid @enderror" name="adresa" value="{{ old('adresa') }}" required autocomplete="street-address">

                                @error('adresa')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pib" class="col-md-4 col-form-label text-md-right">{{ __('PIB') }}</label>

                            <div class="col-md-6">
                                <input id="pib" type="pib" class="form-control @error('pib') is-invalid @enderror" name="pib" value="{{ old('pib') }}" required autocomplete="pib">

                                @error('pib')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="matBr" class="col-md-4 col-form-label text-md-right">{{ __('Maticni broj') }}</label>

                            <div class="col-md-6">
                                <input id="matBr" type="text" class="form-control @error('matBr') is-invalid @enderror" name="matBr" value="{{ old('matBr') }}" required autocomplete="matBr">

                                @error('matBr')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategorije" class="col-md-4 col-form-label text-md-right">{{ __('Kategorije za objavljivanje') }}</label>

                            <div class="col-md-6">
                                <div id="categories" >
                                    <v-select multiple :options="categories"  v-model="selected" >
                                        <template  #search="{attributes, events}">
                                            <input
                                                class="vs__search"
                                                :required="!selected"
                                                v-bind="attributes"
                                                v-on="events"
                                            >
                                        </template>
                                    </v-select>
                                    <input type="hidden" name="kategorije"  id="kategorije" :value="selected">
                                </div>


                                @error('kategorije')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Lozinka') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i style="color: gray;">
                                    <ul>
                                        <li>Minimalno 8 karaktera</li>
                                        <li>Maksimalno 20 karaktera</li>
                                        <li>Minimalno 1 broj</li>
                                    </ul>
                                </i>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Ponovite lozinku') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Posalji zahtev') }}
                                </button>
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

    new Vue({
        el: '#selectMunicipalityContainer',
        data: {
            selected: "{{old('prebivaliste')}}",
            muncipalities: [
                @foreach($mesta as $element)
                    '{{$element->naziv}}',
                @endforeach
            ]
        }
    })
    new Vue({
        el: '#categories',
        data: {
            selected: "{{old('kategorije')}}",
            categories: [
                @foreach($kategorije as $element)
                    '{{$element->naziv}}',
                @endforeach
            ]
        }
    })
</script>
@endsection
