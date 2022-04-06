@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Illustration Details</h3>
        </div>
        <div class="card-body">
            <div class="col">                
                <label style="margin-right: 10px">Gift Card Name:</label>
                <p>{{ $item->item_name }}</p>
                <label style="margin-right: 10px">Gift Card Description:</label>
                <p>{{ $item->item_description }}</p>
            </div>
        </div>
    </div>  
</div>
<div class="card card-primary m-3">
    <div class="card-header">
        <h3 class="card-title">Game Prices</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Size</th>
                <th>Price</th>
                
            </tr>
            @foreach ($illustration_prices as  $prices)
            <tr>
                <td>{{ $prices->size }}</td>
                <td>{{ $prices->price }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="card card-primary m-3">
    <div class="card-header">
        <h3 class="card-title">Illustration Image</h3>
    </div>
    <div class="card-body" style="margin: 0 auto;float: none;margin-bottom: 10px;">
        <img src="{{ asset('images/items/'.$item->item_image) }}" height="500px" style="object-fit: scale-down">
    </div>
</div>
@endsection
