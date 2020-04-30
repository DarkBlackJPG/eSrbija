@extends('layouts.app')







@section('content')
<div class="container">
    <div class="row  ">
        <div class="col-sm-3 col-md-3">
    <form>
            <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search">
    </form>
            <div class="panel-group pt-5" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                            </span>Obavestenja</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">

                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-comment text-success"></span><a href="{{route('home')}}">Vazno</a>
                                        <span class="badge">2</span>

                                    </td>
                                </tr>
                                @foreach (App\Kategorije::all() as $kategorija)
                                    <tr>
                                        <td>
                                            <span class="glyphicon glyphicon-file text-info"></span><a href="{{route('obavestenja_za_kategoriju',$kategorija->id) }}">{{ $kategorija->naziv }}</a>
                                              <input type="checkbox">
                                        </td>

                                    <tr>
                                @endforeach
                               
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
                            </span>Ankete</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="{{route('izbori')}}">Izbori</a> <span class="label label-success"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{route('referendumi')}}">Referendumi</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{route('ankete')}}">Aktivne ankete</a>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->isAdmin)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-user">
                                    </span><a href="{{"/admin/moderators"}}">Zahtevi za moderatora</a>
                            </a>
                        </h4>
                    </div>

                </div>
                @endif
                @if(auth()->user()->isAdmin || auth()->user()->isMod)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
                            </span>Moje objave</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-usd"></span><a href="{{route('mojeankete')}}">Moje ankete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-user"></span><a href="{{route('mojaObavestenja')}}">Moja obavestenja</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-tasks"></span><a href="{{route('createpoll')}}">Napravi anketu</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-shopping-cart"></span> <a  href="{{route('createpost')}}">Napravi obavestenje</a>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                    @endif
            </div>
        </div>
        <div class="col-md-8 justify-content-center">
             @include("sweetalert::alert")
             @yield('homepagecontent')
        </div>

    </div>
</div>
@endsection
