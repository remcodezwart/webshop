@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product overzicht</div>
				@if (!empty($products))
                    @foreach ($products as $product)
                    <div class="panel-heading">Naam <a href="{{ route('product', [$product->name]) }}">{{ $product->name }}</a> 
                            <p>Beschrijving {{ $product->description }}</p>
                            <div class="form-inline form-group">Aantal: <input type="number" min="1" max="{{$product->amount}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-id="{{$product->id}}" class="form-control"> vooraad: {{$product->amount}}, prijs:{{$product->price}} euro per stuk</div><button data-id="{{$product->id}}" class="btn btn-primary cart">toevoegen aan winkelmadtje</button>
                        @foreach ($product->categories as $category)
                            <span class="badge badge-success"><a href="{{ route('search', [$category->name]) }}">{{ $category->name }}</a></span>
                        @endforeach
                    </div>
                    @endforeach
                @else 
                   <div class="panel-heading">Geen producten gevonden</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
