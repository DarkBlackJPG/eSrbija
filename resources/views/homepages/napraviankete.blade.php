@extends('fixed.home')

@section('homepagecontent')

    <div class="container">
        <div class="row"> <form>
                <div class="form-group pt-15">
                    <button type="submit" class="btn btn-primary">
                        Objavi
                    </button>
                    <button class="btn btn-default">
                        Odustani
                    </button>
                </div>
            </form></div>
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
            <form>
            <input type="radio" name="nivo">Lokalni nivo <br/>
            <input type="radio" name="nivo">Nacionalni nivo <br/>
            </form>
            </td>
                </tr>
            </table>

        </div>
        <div class="row pt-5">
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-arrow-right"></span>Pitanje? <a href="http://www.jquery2dotnet.com" target="_blank"><span
                                    class="glyphicon glyphicon-new-window"></span></a>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios">
                                    </label>
                                    Odgovor 1
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios">
                                        Odgovor 2
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios">
                                        Odgovor 3
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios">
                                        Odgovor 4
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios">
                                        Odgovor 5
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-primary btn-sm">
                            Dodaj odgovor</button>
                        <a href="#">Dodaj novo pitanje</a></div>
                </div>
            </div>
        </div>
    </div>



@endsection
