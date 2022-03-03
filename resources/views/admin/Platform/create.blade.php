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
    <form action="{{ route('admin.platforms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Add new Platform</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Platform Description</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="album_name">Platform Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Platform's Name">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Platform Icon</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="icon" name='icon' onchange="onChange(event)">
                            <label class="custom-file-label" for="icon" id='labelvalue'>Choose file</label>
                        </div>
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

<script>
    function onChange(event){
        var imageContainer = document.getElementById('image');
        imageContainer.src = URL.createObjectURL(event.target.files[0]);
        imageContainer.style.display = 'block';
    }
</script>
@endsection