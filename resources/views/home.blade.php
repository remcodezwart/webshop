@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Gebruikers instellingen</div>

                <div class="panel-body">
                
                    <form method="POST">
                        
                        <div class="form-group">
                            <label>Voornaam</label>
                            <input class="form-control" type="text" name="firstName" @if(!empty($client)) value="{{ $client->name }}" @endif>
                        </div>
                        <div class="form-group">
                            <label>tussenvoegsel</label>
                            <input class="form-control" type="text" name="middleName" @if(!empty($client)) value="{{ $client->middle_name }}" @endif>
                        </div>
                        <div class="form-group">
                            <label>Achternaam</label>
                            <input class="form-control" type="text" name="lastName" @if(!empty($client)) value="{{ $client->last_name }}"@endif>
                        </div>
                        <div class="form-group">
                            <label>Straat</label>
                            <input class="form-control" type="text" name="street" @if(!empty($client)) value="{{ $client->street }}" @endif>
                        </div>
                        <div class="form-group">
                            <label>Huisnummer</label>
                            <input class="form-control" type="text" name="housnumber" @if(!empty($client)) value="{{ $client->house_number }}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="postCode">Postcode</label>
                            <input class="form-control" id="postCode" type="text" name="postCode" @if(!empty($client)) value="{{ $client->post_code }}"@endif>
                        </div>
                        <div class="form-group">
                            <label>Geslacht</label>
                            <label class="radio-inline"><input type="radio" value="male" name="gender" @if(!empty($client) && $client->gender === 'male') checked="true" @endif>Man</label>
                            <label class="radio-inline"><input type="radio" value="female" name="gender" @if(!empty($client) && $client->gender === 'female') checked="true" @endif>Vrouw</label>
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
