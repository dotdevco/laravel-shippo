@extends('layouts.main')

@section('content')
    <h1>Thank you!</h1>

    <p class="lead">Thank you for purchase. Below is your receipt and tracking information:</p>

    <table class="table">
        <tr>
            <td>Order Id:</td>
            <td>#9898</td>
        </tr>
        <tr>
            <td>Tracking Number:</td>
            <td>
                <a href="{{ $shipping['tracking_url_provider'] }}">{{ $shipping['tracking_number'] }}</a>
            </td>
        </tr>
    </table>
@endsection