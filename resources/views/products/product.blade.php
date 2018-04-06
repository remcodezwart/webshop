@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product overzicht</div>
				@if (!empty($product))
                    <div class="panel-heading">
                    		<p>Naam: {{ $product['0']->name }}</p>
                            <p>Beschrijving: {{ $product['0']->description }}</p>
                            <p>prijs: {{ $product['0']->price }}</p>
                            <p>aantal in de vooraad: {{ $product['0']->amount }}</p>
                        @foreach ($product['0']->categories as $category)
                            <span class="badge badge-success"><a href="{{ route('search', [$category]) }}">{{ $category }}</a></span>
                        @endforeach
                    </div>
                @else 
                   <div class="panel-heading">Geen product gevonden</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
