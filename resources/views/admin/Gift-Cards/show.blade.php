@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Gift Card Details</h3>
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

    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Game Prices</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Card Type</th>
                    <th>Price</th>
                    
                </tr>
                @foreach ($gift_card as  $card)
                <tr>
                    <td>{{ $card->card_type }}</td>
                    <td>{{ $card->card_price }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    
</div>
@endsection