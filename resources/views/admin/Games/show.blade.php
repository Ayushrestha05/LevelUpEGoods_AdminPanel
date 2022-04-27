@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Game Details</h3>
        </div>
        <div class="card-body">
            <div class="col">                
                <label style="margin-right: 10px">Game Name:</label>
                <p>{{ $item->item_name }}</p>
                <label style="margin-right: 10px">Game Description:</label>
                <p>{{ $item->item_description }}</p>
                <label style="margin-right: 10px">Game Release Date:</label>
                <p>{{ $game_description->release_date->format(' d F Y') }}</p>
            </div>
        </div>
    </div>

    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Game Images</h3>
        </div>
        <div class="card-body">
                     
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($gameImages as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" >
                            <img src="{{ asset('images/games/'.$image) }}" alt="{{ $image }}" class="d-block w-100" style="object-fit: scale-down; height: 500px;">
                        </div>
                    @endforeach
                </div>
                
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                    <span class="sr-only">Next</span>
                </a>
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
                    <th>Platform</th>
                    <th>Price</th>
                </tr>
            
                @foreach ($platforms as $platform)
                    @if (($item->GamePrices->where('platform_id',$platform->id)->first()->price ?? '') == '' )
                    @else
                    <tr>
                        <td>{{ $platform->name }}</td>
                        <td>{{ $item->GamePrices->where('platform_id',$platform->id)->first()->price}}</td>
                    </tr>
                    @endif
                @endforeach
            </table>       
        </div>
    </div>
    
</div>
@endsection