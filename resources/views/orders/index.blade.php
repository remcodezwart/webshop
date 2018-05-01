@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product overzicht</div>
				@if (!empty($orders))
                    <div class="panel-heading">
                        @foreach ($orders as $order)
                            <p>order: {{ $order->id }}</p>
                        @endforeach
                    </div>
                @else 
                   <div class="panel-heading">Geen orders</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
