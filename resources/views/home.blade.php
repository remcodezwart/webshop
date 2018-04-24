@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Gebruikers instellingen</div>

                <div class="panel-body">
                   

                    <form method="POST" action="/profile">
                        
                        <div class="form-group">
                            <label>Voornaam</label>
                            <input class="form-control" type="text" name="firstName">
                        </div>
                        <div class="form-group">
                            <label>tussenvoegsel</label>
                            <input class="form-control" type="text" name="middleName">
                        </div>
                        <div class="form-group">
                            <label>Achternaam</label>
                            <input class="form-control" type="text" name="lastName">
                        </div>
                        <div class="form-group">
                            <label>Straat</label>
                            <input class="form-control" type="text" name="street">
                        </div>
                        <div class="form-group">
                            <label>Huisnummer</label>
                            <input class="form-control" type="text" name="housnumber">
                        </div>
                        <div class="form-group">
                            <label for="postCode">Postcode</label>
                            <input class="form-control" id="postCode" type="text" name="postCode">
                        </div>
                        <div class="form-group">
                            <label>Geslacht</label>
                            <label class="radio-inline"><input type="radio" name="gender">Man</label>
                            <label class="radio-inline"><input type="radio" name="gender">Vrouw</label>
                        </div>
                        {{ csrf_field() }}
                        <button class="btn btn-primary" type="submit">Opslaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
