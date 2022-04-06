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
    <form action="{{ route('admin.reward-items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Add new Reward Item</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Reward Description</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="album_name">Reward Item</label>
                        <input type="text" class="form-control" name="item_name" placeholder="Enter Reward Item's Name">
                    </div>
                    <div class="input-group d-flex flex-column">
                        <label>Reward Item Image</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="image" name='image'>
                            <label class="custom-file-label" for="image" id='labelvalue'>Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="album_name">Reward Points Required</label>
                        <input type="text" class="form-control" name="reward_points" placeholder="Enter the Amount of Reward Points required to redeem this reward">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Stock Left</label>
                        <input type="text" class="form-control" name="stock" placeholder="Enter the Amount of times this reward can be redeemed by all">
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