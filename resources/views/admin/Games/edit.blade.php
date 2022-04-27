@extends('layouts.admin')

@section('content')
<div class="float-right mr-3 mt-2">
    <a href="{{ route('admin.games.index') }}"><h5><b>&lt; Back</h5></b></a>
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
    <form action="{{ route('admin.games.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Edit existing Game</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Game Description</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="game_name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Game's Name" value="{{ $item->item_name }}">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Description</label>
                        <textarea class='form-control' name="description" rows="3" placeholder="Enter Game's Description">{{ $item->item_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Release Date</label>
                        <input type="date" class="form-control" name='release_date' value="{{ $game_description->release_date->format('Y-m-d') }}"> 
                    </div>
                    <div class="input-group">
                        <label>Game Cover Image</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="image" name='image' onchange="loadFile(event)">
                            <label class="custom-file-label" for="image" id='labelvalue'>{{ $item->item_image }}</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" >
                        <img height="200" width="400" style="object-fit:scale-down;display:none" id="uploadImage">
                    </div>
                    <div class="form-group">
                        <label for="album_name">Youtube Trailer Link</label>
                        <input type="text" class="form-control" name="youtube" placeholder="Enter Game's Trailer Youtube Link" value="{{ $game_description->trailer_url }}">
                    </div>
                    <div class="form-group">
                        <label>Images</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="game_image_file" name="gamesImage[]" multiple>
                            <label class="custom-file-label">{{ $game_description->image_url }}</label>
                        </div>
                    </div>
                    <div>
                        <label>Type of Game</label>
                        <br>
                        <div class="d-flex flex-row">
                            
                            @if ($item->category_id == 4 && $item->GamePrices->count() == 0)
                                <div class="mr-3">
                                    <input type="radio" name="game_type" id="game_type" value="upcoming" checked onchange="onChangeRadio(event)">
                                    <label for="upcoming">Upcoming</label>
                                </div>
                            @else
                            <div class="mr-3">
                                <input type="radio" name="game_type" id="game_type" value="upcoming" onchange="onChangeRadio(event)">
                                <label for="upcoming">Upcoming</label>
                            </div>
                            @endif
                            
                            @if ($item->category_id == 4 && $item->GamePrices->count() > 0)
                                <div class="mr-3">
                                    <input type="radio" name="game_type" id="game_type" value="released" checked onchange="onChangeRadio(event)">
                                    <label for="upcoming">Released</label>
                                </div>
                                
                            @else
                                <div class="mr-3">
                                    <input type="radio" name="game_type" id="game_type" value="released" onchange="onChangeRadio(event)">
                                    <label for="upcoming">Released</label>
                                </div>
                            @endif
                            
                            @if ($item->category_id == 5)
                                <div class="mr-3">
                                    <input type="radio" name="game_type" id="game_type" value="playstation" checked onchange="onChangeRadio(event)">
                                    <label for="upcoming">Playstation Exclusive</label>
                                </div>
                            @else
                                <div class="mr-3">
                                    <input type="radio" name="game_type" id="game_type" value="playstation" onchange="onChangeRadio(event)">
                                    <label for="upcoming">Playstation Exclusive</label>
                                </div>
                            @endif
                            
                            @if ($item->category_id == 6)
                                <div class="mr-3">
                                    <input type="radio" name="game_type" id="game_type" value="switch" checked onchange="onChangeRadio(event)">
                                    <label for="upcoming">Switch Exclusive</label>
                                </div>                                
                            @else
                                <div class="mr-3">
                                    <input type="radio" name="game_type" id="game_type" value="switch" onchange="onChangeRadio(event)">
                                    <label for="upcoming">Switch Exclusive</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Released Game Body --}}
            <div class="card card-primary m-3" id="released" style="display: none">
                <div class="card-header">
                    <h3 class="card-title">Game Prices</h3>
                </div>
                <div class="card-body d-flex flex-column" id="album_content">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Platform</th>
                            <th>Price</th>
                        </tr>
                    
                        @foreach ($platforms as $platform)
                        <tr>
                            <td>{{ $platform->name }}</td>
                            <input type="text" value="{{ $platform->id }}" name=" {{ "released[".$platform->id."][platform]" }}" style="display: none">
                            <td><input type="text" class="form-control" name=" {{ "released[".$platform->id."][price]" }}" placeholder="Enter Price" value="{{ $item->GamePrices->where('platform_id',$platform->id)->first()->price ?? ''}}"></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>    
            
            {{-- Playstation Exclusives --}}
            <div class="card card-primary m-3" id="playstation" style="display: none">
                <div class="card-header">
                    <h3 class="card-title">Game Prices</h3>
                </div>
                <div class="card-body d-flex flex-column" id="album_content">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Platform</th>
                            <th>Price</th>
                        </tr>
                       
                        @foreach ($platforms->where('platform_family','playstation') as $selectedPlatforms)
                        
                        <tr>
                            <td>{{ $selectedPlatforms->name }}</td>
                            <input type="text" value="{{ $selectedPlatforms->id }}" name=" {{ "playstation[".$selectedPlatforms->id."][platform]" }}" style="display: none">
                            <td><input type="text" class="form-control" name=" {{ "playstation[".$selectedPlatforms->id."][price]" }}" placeholder="Enter Price" value="{{ $game_platforms->where('platform_id',$selectedPlatforms->id)->first()->price ?? ''}}"></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>  

            {{-- Switch Exclusives --}}
            <div class="card card-primary m-3" id="nintendo" style="display: none">
                <div class="card-header">
                    <h3 class="card-title">Game Prices</h3>
                </div>
                <div class="card-body d-flex flex-column" >
                    <table class="table table-bordered">
                        <tr>
                            <th>Platform</th>
                            <th>Price</th>
                        </tr>
                        @foreach($platforms->where('platform_family','nintendo') as $selectedPlatforms)
                        <tr>
                            <td>{{ $selectedPlatforms->name }}</td>
                            <input type="text" value="{{ $selectedPlatforms->id }}" name=" {{ "switch[".$selectedPlatforms->id."][platform]" }}" style="display: none">
                            <td><input type="text" class="form-control" name=" {{ "switch[".$selectedPlatforms->id."][price]" }}" placeholder="Enter Price" value="{{ $game_platforms->where('platform_id',$selectedPlatforms->id)->first()->price ?? '' }}"></td>
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

<script>
    function onLoad(){
        if({{ $item->category_id }} == 4 && {{ $item->GamePrices->count() }} == 0){
            document.getElementById('released').style.display = 'none';
            document.getElementById('playstation').style.display = 'none';
            document.getElementById('nintendo').style.display = 'none';
        }else if({{ $item->category_id }} == 4 && {{ $item->GamePrices->count() }} > 0){
            document.getElementById('released').style.display = 'block';
            document.getElementById('playstation').style.display = 'none';
            document.getElementById('nintendo').style.display = 'none';
        }else if({{ $item->category_id }} == 5){
            document.getElementById('playstation').style.display = 'block';
            document.getElementById('released').style.display = 'none';
            document.getElementById('nintendo').style.display = 'none';
        }else if({{ $item->category_id }} == 6){
            document.getElementById('nintendo').style.display = 'block';
            document.getElementById('released').style.display = 'none';
            document.getElementById('playstation').style.display = 'none';
        }
    
    }

    onLoad();
    function onChangeRadio(event){
        var value = event.target.value;
        switch(value){
            case 'upcoming':
                document.getElementById('released').style.display = 'none';
                document.getElementById('playstation').style.display = 'none';
                document.getElementById('nintendo').style.display = 'none';
                break;
            case 'released':
                document.getElementById('released').style.display = 'block';
                document.getElementById('playstation').style.display = 'none';
                document.getElementById('nintendo').style.display = 'none';
                break;

            case 'playstation':
                document.getElementById('playstation').style.display = 'block';
                document.getElementById('released').style.display = 'none';
                document.getElementById('nintendo').style.display = 'none';
                break;

            case 'switch':
                document.getElementById('nintendo').style.display = 'block';
                document.getElementById('released').style.display = 'none';
                document.getElementById('playstation').style.display = 'none';
                break;
        }
    }
</script>
@endsection