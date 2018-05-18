@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product overzicht</div>
				@if (!empty($product))
                    <div class="panel-heading">
                    		<p>Naam: {{ $product->name }}</p>
                            <p>Beschrijving: {{ $product->description }}</p>
                            <p>prijs: {{ $product->price }}</p>
                            <p>aantal in de vooraad: {{ $product->amount }}</p>
                            <p>Aantal: <input type="number" min="1" max="{{$product->amount}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-id="{{$product->id}}" class="form-control"><button data-id="{{$product->id}}" class="btn btn-primary cart">toevoegen aan winkelmadtje</button></p>
                                @foreach ($product->categories as $category)
                                    <span class="badge badge-success"><a href="{{ route('search', [$category->name]) }}">{{ $category->name }}</a></span>
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
