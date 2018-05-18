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
