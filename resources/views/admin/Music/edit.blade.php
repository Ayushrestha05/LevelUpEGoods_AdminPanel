@extends('layouts.admin')

@section('content')
<div class="float-right mr-3 mt-2">
    <a href="{{ route('admin.music.index') }}"><h5><b>&lt; Back</h5></b></a>
</div>
<div class="col mt-1 d-flex flex-column">
    
    @if ($errors->any())
    <div class="alert alert-danger m-2">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.music.update',$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Edit Existing Music</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Album Description</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="album_name">Album Name</label>
                        <input type="text" class="form-control" name="album_name" placeholder="Enter Album's Name" value="{{ $item->item_name }}">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Album Artist</label>
                        <input type="text" class="form-control" name="album_artist" placeholder="Enter Album's Artist(s)" value="{{ $item->item_description }}">
                    </div>
                </div>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Album Details</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="album_name">Album Type</label>
                        <select class="custom-select rounded-0" name="album_type" id="album_type">
                            <option value="">Choose...</option>                            
                            <option value="Single" <?php if($music->music_type=="Single") echo 'selected="selected"'; ?>>Single</option>                            
                            <option value="EP" <?php if($music->music_type=="EP") echo 'selected="selected"'; ?>>EP</option>                            
                            <option value="Album" <?php if($music->music_type=="Album") echo 'selected="selected"'; ?>>Album</option>            
                            <option value="Remix" <?php if($music->music_type=="Remix") echo 'selected="selected"'; ?>>Remix</option>
                      
                            
                        </select>
                    </div>
                    <div class="input-group d-flex flex-column">
                        <label>Album Image</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="album_image" name='album_image' onchange="loadFile(event)">
                            <label class="custom-file-label" for="album_image" id='labelvalue'>{{ $item->item_image }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Digital Price</label>
                        <input type="text" class="form-control" name="digital_price" placeholder="Enter the Album's Digital Price" value="{{ $music->digital_price }}">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Physical Price</label>
                        <input type="text" class="form-control" name="physical_price" placeholder="Enter the Album's Physical Price" value="{{ $music->physical_price }}">
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
            
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
        </div>   
    </form>
</div>

@endsection