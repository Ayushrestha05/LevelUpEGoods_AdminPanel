@extends('layouts.admin')

@section('content')
<div class="float-right mr-3 mt-2">
    <a href="{{ route('admin.figurine.index') }}"><h5><b>&lt; Back</h5></b></a>
</div>
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

<div class="col mt-1 d-flex flex-column">
    <form action="{{ route('admin.figurine.update',$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Updated Existing Figurine</h3>
            </div>
            <div class="card card-primary m-3 ">
                <div class="card-header">
                    <h3 class="card-title">Figurine Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="figurineName">Figurine Name</label>
                        <input type="text" class="form-control" name="figurineName" placeholder="Enter Figurine Name" value="{{ $item->item_name }}">
                    </div>
                    <div class="form-group">
                        <label for="figurineDescription">Figurine Description</label>
                        <textarea class='form-control' name="figurineDescription" rows="3" placeholder="Enter Figurine's Description" >{{ $figurine->figure_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="figurineHeight">Figurine Height</label>
                        <input type="text" class="form-control" name="figurineHeight" placeholder="Enter Figurine Height" value="{{ $figurine->figure_height }}">
                    </div>
                    <div class="form-group">
                        <label for="figurineDimension">Figurine Dimension</label>
                        <input type="text" class="form-control" name="figurineDimension" placeholder="Enter Figurine's Dimensions" value="{{ $figurine->figure_dimension }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="figurineHeight">Figurine Image</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="fig_image_file" name="figurineImage">
                            <label class="custom-file-label" id="labelvalue">{{ $item->item_image }}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="figurinePrice">Figurine Price</label>
                        <input type="text" class="form-control" name="figurinePrice" placeholder="Enter Figurine Price" value="{{ $figurine->figure_price }}">
                    </div>
                </div>
                <!-- /.card-body -->
                
                
            </div>
            <div class="card card-primary m-3 ">
                <div class="card-header">
                    <h3 class="card-title">Figurine Images</h3>
                </div>
                <div class="form-group p-3">
                <div class="custom-file w-100 mb-3">
                    <input type="file" class="custom-file-input" id="fig_image_file" multiple name="figurineImageFile[]">
                    <label class="custom-file-label" id="labelvalue">{{ $figurineImages }}</label>
                </div>
            </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

@endsection