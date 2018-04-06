@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product in de categorie: {{ $categorie }}</div>
				@if (!empty($products))
                    @foreach ($products as $product)
                    <div class="panel-heading">
                            <p>Naam <a href="{{ route('product', [$product->name]) }}">{{ $product->name }}</a></p>
                            <p>Beschrijving {{ $product->description }}</p>
                        @foreach ($product->categories as $category)
                            <span class="badge badge-success"><a href="{{ route('search', [$category]) }}">{{ $category }}</a></span>
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
