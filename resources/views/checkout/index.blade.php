@extends('layouts.main')

@section('content')
    <h1>Shipping</h1>

    <form action="/checkout" method="post">
        {{ csrf_field() }}
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Price</th>
            </tr>
            @foreach ($rates->results as $rate)
            <tr>
                <td>
                    <img src="{{ $rate->provider_image_75 }}" alt="">
                    {{ $rate->provider }} ({{ $rate->duration_terms }})
                </td>
                <td width="20%">
                    <input type="radio" class="pull-right" name="rate" value="{{ $rate->object_id }}">
                    ${{ $rate->amount }}
                </td>
            </tr>
            @endforeach
        </table>
        <button class="btn btn-default">Next</button>
    </form>
@endsection