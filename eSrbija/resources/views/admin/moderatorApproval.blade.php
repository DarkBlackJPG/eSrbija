@extends('fixed.home')

@section('homepagecontent')
    <script>
        Vue.component('v-select', VueSelect.VueSelect)
    </script>
    @if(session('successApprove'))
        <script>
            Toast.fire({
                icon: 'success',
                title: '{{session('successApprove')}}',
            })
        </script>
    @endif
    @if(session('successReject'))
        <script>
            Toast.fire({
                icon: 'warning',
                title:'{{session('successReject')}}',
            })
        </script>
    @endif
    <div class="container">
        <div class="row ">
            <div class="col-md-7">
                @if(sizeof($moderatori) > 0)

                    @foreach($moderatori as $moderator)
                    <div class="card p-0 shadow">
                    <div class="card-header">
                        {{$moderator['naziv']}}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row col-md-12">
                               <label class="col-md-4">
                                   Naziv:
                               </label>
                                <label class="offset-1 col-md-7">
                                    {{$moderator['naziv']}}
                                </label>
                            </div>
                            <hr/>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Opstina:
                                </label>
                                <label class="offset-1 col-md-7">
                                    {{$moderator['opstina']}}
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Adresa:
                                </label>
                                <label class="offset-1 col-md-7">
                                    {{$moderator['adresa'] }}
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    PIB:
                                </label>
                                <label class="offset-1 col-md-7">
                                    {{$moderator['pib']}}
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Maticni broj:
                                </label>
                                <label class="offset-1 col-md-7">
                                    {{$moderator['maticniBroj'] }}
                                </label>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <label class="col-md-4">
                                    Kategorije za objave:
                                </label>
                                <div class=" categories offset-1 col-md-7" id="element{{$moderator['id']}}">
                                    <v-select multiple :options="categories"  v-model="selected" >
                                        <template  #search="{attributes, events}">
                                            <input
                                                class="vs__search"
                                                :required="!selected"
                                                v-on="events"
                                                :v-bind="selected"
                                                value="{{old('prebivaliste')}}"
                                            >
                                        </template>
                                    </v-select>
                                    <input type="hidden" name="opstina"  id="opstina" :value="selected">
                                </div>
                                <script>
                                    new Vue({
                                        el:'#element{{$moderator['id']}}',
                                        data: {
                                            selected: [
                                                @foreach($moderator['ovlascenja'] as $ovlascenje)
                                                '{{$ovlascenje->naziv}}',
                                                @endforeach
                                            ],
                                            categories: [
                                                @foreach($kategorije as $kategorija)
                                                    '{{$kategorija}}',
                                                @endforeach
                                            ]
                                        }

                                    })
                                </script>
                            </div>
                            <hr>
                            <div class="row col-md-12">
                                <div class="offset-md-4">
                                    <button formaction="{{route('admin.moderatorReject',['id'=>$moderator['id']])}}" type="submit" class="btn btn-danger"><i class="fas fa-times">&nbsp;Odbij</i></button>
                                    <button formaction="{{route('admin.moderatorApprove',['id'=>$moderator['id']])}}" type="submit" class="btn btn-success"><i class="fas fa-check">&nbsp;Odobri</i></button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
                    <div class="row">&nbsp;</div>
                    @endforeach
                @else
                    <div class ="card">
                        <div class="card-header"></div>
                            <div class="card-body"> <h3>Nema neobradjenih moderatora</h3> </div>
                        <div class="card-footer"></div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
