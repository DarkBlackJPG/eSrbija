@extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registracija korisnika') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.register') }}">
                            @csrf

                            <!-- Ime -->
                            <div class="form-group row">
                                <label for="ime" class="col-md-4 col-form-label text-md-right">{{ __('Ime') }}</label>

                                <div class="col-md-6">
                                    <input id="ime" type="text" class="form-control @error('ime') is-invalid @enderror" name="ime" value="{{ old('ime') }}" required autocomplete="ime" autofocus>

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
                                    <input id="prezime" type="text" class="form-control @error('prezime') is-invalid @enderror" name="prezime" value="{{ old('prezime') }}" required autocomplete="prezime" autofocus>

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
                                    <input id="rodjendan" type="date" class="form-control @error('rodjendan') is-invalid @enderror" name="rodjendan" value="{{ old('rodjendan') }}" required autocomplete="rodjendan" autofocus>

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

                                                    value="{{old('prebivaliste')}}"
                                                   >
                                            </template>
                                        </v-select>
                                        <input type="hidden" name="prebivaliste"  id="birthCity" :value="selected{{old('prebivaliste')}}">
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
                                        <input type="hidden" name="rodjenje"  id="birthCity" :value="selected{{old('prebivaliste')}}">
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
                                    <input id="adresaPrebivalista" type="address" class="form-control @error('adresaPrebivalista') is-invalid @enderror" name="adresaPrebivalista" required >

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
                                    <input id="JMBG" type="text" class="form-control @error('JMBG') is-invalid @enderror" name="JMBG" required >

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
                                        <input class="form-check-input @error('pol') is-invalid @enderror" type="radio" name="pol" id="muski" value="m">
                                        <label class="form-check-label @error('pol') is-invalid @enderror" for="Muski">
                                            Muski
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('pol') is-invalid @enderror" type="radio" name="pol" id="zenski" value="z">
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
                                    <input id="brojLicne" type="text" class="form-control @error('brojLicne') is-invalid @enderror" name="brojLicne" required>

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
                selected: '',
                muncipalities: ['Subotica', 'Beograd', 'Novi Sad']
            }
        })
        new Vue({
            el: '#muncipalityContainer',
            data: {
                selected: '',
                muncipalities: ['Subotica', 'Beograd', 'Novi Sad']
            }
        })
    </script>
@endsection
