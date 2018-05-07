@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product overzicht</div>
				@if (!empty($order))
                    <div class="panel-heading">
                        status: {{ $order->status }} <br>
                        datum besteld: {{ $order->date_order }} <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>prijs</th>
                                    <th>aantal</th>
                                    <th>totaal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderLines as $orderline)
                                    <tr>
                                        <th>{{ $orderline['price'] }}</th>
                                        <th>{{ $orderline['amount'] }}</th>
                                        <th>{{ $orderline['amount']*$orderline['price'] }}</th>
                                    </tr>
                                    <?php $total += $orderline['amount']*$orderline['price'] ?>
                                @endforeach
                            </tbody>
                        </table>
                        Totaal prijs : &#8364;{{$total }}


                    </div>
                @else 
                   <div class="panel-heading">Order niet gevonden</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
