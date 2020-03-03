@extends('fixed.home')

@section('homepagecontent')
        <div class="col-md-8 col-md-offset-2">

            <h1>Novo obavestenje</h1>

            <form action="" method="POST">

                <div class="form-group has-error pt-5">
                    <label for="slug">Kategorija  </label>
                    <br/>
                    <select multiple>
                        <option>Sport</option>
                        <option>Zdravlje</option>
                        <option>Finansije</option>
                        <option>Kultura</option>
                        <option>Energetika</option>
                        <option>VAZNO</option>
                    </select>
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

@endsection
