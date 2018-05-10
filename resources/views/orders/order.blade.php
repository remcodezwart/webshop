@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (!empty($order))
                <div class="panel-heading">
                    order {{ $order->id }}</div>
                    <div class="panel-heading">
                        status: {{ $order->status }} <br>
                        datum besteld: {{ $order->date_order }} <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>naam</th>
                                    <th>prijs</th>
                                    <th>aantal</th>
                                    <th>totaal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderLines as $orderline)
                                    <tr>
                                        <td>{{ $orderline->product['name'] }}</td>
                                        <td>{{ $orderline['price'] }}</td>
                                        <td>{{ $orderline['amount'] }}</td>
                                        <td>&#8364;{{ $orderline['amount']*$orderline['price'] }}</td>
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
