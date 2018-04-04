@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product overzicht</div>
				
				@foreach ($products as $product)
				<div class="panel-heading">Naam {{ $product->name }}
	 				<p>Beschrijving {{ $product->description }}</p>
                    @foreach ($product->categories as $category)
                        <span class="badge badge-success">{{ $category }}</span>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
