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
    <form action="{{ route('admin.ads.update',$ad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Add new AD</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">AD Details</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="album_name">AD Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter AD title" value="{{ $ad->title }}">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">AD Description</label>
                        <textarea class='form-control' name="description" rows="3" placeholder="Enter AD Description">{{ $ad->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="album_artist">AD Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="icon" name='image'>
                            <label class="custom-file-label" for="icon" id='labelvalue'>{{ $ad->image_url }}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>AD Active</label>
                        <select class="form-control" name="active" id="status" >
                            <option value="true" <?php if($ad->active=="true") echo 'selected="selected"'; ?>>True</option>
                            <option value="false" <?php if($ad->active=="false") echo 'selected="selected"'; ?>>False</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <img id="image" width="200px" height="200px" style="object-fit:scale-down;display: none;">
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
        </div>   
    </form>
</div>
@endsection