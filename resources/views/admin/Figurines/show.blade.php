@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Figurine Details</h3>
        </div>
        <div class="card-body">
            <div class="col">                
                <label style="margin-right: 10px">Figurine Name:</label>
                <p>{{ $item->item_name }}</p>
                <label style="margin-right: 10px">Figurine Description:</label>
                <p>{{ $figurine->figure_description }}</p>

                @if ($figurine->figure_height != null)
                    <label style="margin-right: 10px">Figurine Height:</label>
                    <p>{{ $figurine->figure_height }}</p>
                @endif

                @if ($figurine->figure_dimension != null)
                    <label style="margin-right: 10px">Figurine Dimensions:</label>
                    <p>{{ $figurine->figure_dimension }}</p>
                @endif

                <label style="margin-right: 10px">Figurine Price:</label>
                <p>{{ $figurine->figure_price }}</p>
            </div>
        </div>
    </div>

    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Figurine Images</h3>
        </div>
        <div class="card-body">
                     
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($figurineImages as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" >
                            <img src="{{ asset('images/figurines/'.$image) }}" alt="{{ $image }}" class="d-block w-100" style="object-fit: scale-down; height: 500px;">
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
    
</div>

@endsection