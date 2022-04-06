@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Music Details</h3>
        </div>
        <div class="card-body">
            <div class="col">                
                <label style="margin-right: 10px">Music Name:</label>
                <p>{{ $item->item_name }}</p>
                <label style="margin-right: 10px">Music Artist:</label>
                <p>{{ $item->item_description }}</p>
                <label style="margin-right: 10px">Album Type:</label>
                <p>{{ $music->music_type }}</p>
                @if ($music->digital_price)
                    <label style="margin-right: 10px">Digital Price:</label>
                    <p>{{ $music->digital_price }}</p>
                @endif
                @if ($music->physical_price)
                    <label style="margin-right: 10px">Physical Price:</label>
                    <p>{{ $music->physical_price }}</p>
                @endif
            </div>
        </div>
    </div>  
    <div class="card card-primary m-3">
        <div class="card-header">
            <h3 class="card-title">Music Tracks</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Track Name</th>
                    <th>Track Time</th>
                    <th>Track</th>
                </tr>
                @foreach ($musicTracks as $track )
                    <tr>
                        <td>{{ $track->track_name }}</td>
                        <td>{{ $track->track_time }}</td>
                        <td><audio controls><source  src="{{ asset('music/'.$track->track_file) }}" type="audio/mpeg"></audio></td>                    
                    </tr>
                @endforeach
            </table>
        </div>
    </div> 
</div>
@endsection
