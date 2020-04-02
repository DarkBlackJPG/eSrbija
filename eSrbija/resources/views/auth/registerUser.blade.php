@extends('layouts.guest')

    @section('content')
    <link rel="stylesheet" href="{{asset('css/authentication.css')}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card no-padding">
                    <div class="card-header"><h3>{{ __('Registracija korisnika') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.register.save') }}">
                            @csrf

                            <!-- Ime -->
                            <div class="form-group row">
                                <label for="ime" class="col-md-4 col-form-label text-md-right">{{ __('Ime') }}</label>

                                <div class="col-md-6">
                                    <input id="ime" type="text" class="form-control @error('ime') is-invalid @enderror" name="ime" value="{{ old('ime') }}" required autocomplete="given-name" autofocus>

                                    @error('ime')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Prezime -->
                            <div class="form-group row">
                                <label for="prezime" class="col-md-4 col-form-label text-md-right">{{ __('Prezime') }}</label>

                                <div class="col-md-6">
                                    <input id="prezime" type="text" class="form-control @error('prezime') is-invalid @enderror" name="prezime" value="{{ old('prezime') }}" required autocomplete="family-name" autofocus>

                                    @error('prezime')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                             <!-- Datum rodjenja -->
                            <div class="form-group row">
                                <label for="rodjendan" class="col-md-4 col-form-label text-md-right">{{ __('Datum rodjenja') }}</label>

                                <div class="col-md-6">
                                    <input id="rodjendan" type="date" class="form-control @error('rodjendan') is-invalid @enderror" name="rodjendan" value="{{ old('rodjendan') }}" required autocomplete="bday" autofocus>

                                    @error('rodjendan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Opstina prebivalista -->
                            <div class="form-group row">
                                <label for="prebivaliste" class="col-md-4 col-form-label text-md-right">{{ __('Opstina prebivalista') }}</label>

                                <div class="col-md-6">
                                    <div id="selectMunicipalityContainer" >
                                        <v-select :options="muncipalities"  v-model="selected" >
                                            <template  #search="{attributes, events}">
                                                <input
                                                    class="vs__search"
                                                    :required="!selected"
                                                    v-bind="attributes"
                                                    v-on="events"
                                                   >
                                            </template>
                                        </v-select>
                                        <input type="hidden" name="prebivaliste"  id="birthCity" :value="selected">
                                    </div>
                                    @error('prebivaliste')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Opstina rodjenja -->
                            <div class="form-group row">
                                <label for="rodjenje" class="col-md-4 col-form-label text-md-right">{{ __('Opstina rodjenja') }}</label>

                                <div class="col-md-6">
                                    <div id="muncipalityContainer">
                                        <v-select :options="muncipalities" v-model="selected">
                                            <template #search="{attributes, events}">
                                                <input
                                                    class="vs__search"
                                                    :required="!selected"
                                                    v-bind="attributes"
                                                    v-on="events"
                                                    id="livingMuncipality">
                                            </template>
                                        </v-select>
                                        <input type="hidden" name="rodjenje"  id="birthCity" :value="selected">
                                    </div>


                                    @error('rodjenje')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Adresa prebivalista -->
                            <div class="form-group row">
                                <label for="adresaPrebivalista" class="col-md-4 col-form-label text-md-right">{{ __('Adresa prebivalista') }}</label>

                                <div class="col-md-6">
                                    <input id="adresaPrebivalista" type="address" class="form-control @error('adresaPrebivalista') is-invalid @enderror" value="{{old('adresaPrebivalista')}}" name="adresaPrebivalista" required autocomplete="street-address">

                                    @error('adresaPrebivalista')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- JMBG -->
                            <div class="form-group row">
                                <label for="JMBG" class="col-md-4 col-form-label text-md-right">{{ __('JMBG') }}</label>

                                <div class="col-md-6">
                                    <input id="JMBG" type="text" class="form-control @error('JMBG') is-invalid @enderror" name="JMBG" value="{{old('JMBG')}}" required >

                                    @error('JMBG')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pol -->
                            <div class="form-group row">
                                <label for="pol" class="col-md-4 col-form-label text-md-right">{{ __('Pol') }}</label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input @error('pol') is-invalid @enderror" type="radio" name="pol" id="muski" value="1" checked>
                                        <label class="form-check-label @error('pol') is-invalid @enderror" for="Muski">
                                            Muski
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('pol') is-invalid @enderror" type="radio" name="pol" id="zenski" value="0">
                                        <label class="form-check-label @error('pol') is-invalid @enderror" for="Zenski">
                                            Zenski
                                        </label>
                                    </div>
                                    @error('pol')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="brojLicne" class="col-md-4 col-form-label text-md-right">{{ __('Broj licne karte') }}</label>

                                <div class="col-md-6">
                                    <input id="brojLicne" type="text" class="form-control @error('brojLicne') is-invalid @enderror" value="{{old('brojLicne')}}" name="brojLicne" required>

                                    @error('brojLicne')
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
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Ponovi lozinku') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registruj se') }}
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
            el: '#muncipalityContainer',
            data: {
                selected: "{{old('rodjenje')}}",
                muncipalities: [
                    @foreach($mesta as $element)
                        '{{$element->naziv}}',
                    @endforeach
                ]
            }
        })
    </script>
@endsection
