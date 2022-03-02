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
    <form action="{{ route('admin.figurine.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Add new Figurine</h3>
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
                        <input type="text" class="form-control" name="figurineName" placeholder="Enter Figurine Name">
                    </div>
                    <div class="form-group">
                        <label for="figurineDescription">Figurine Description</label>
                        <textarea class='form-control' name="figurineDescription" rows="3" placeholder="Enter Figurine's Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="figurineHeight">Figurine Height</label>
                        <input type="text" class="form-control" name="figurineHeight" placeholder="Enter Figurine Height">
                    </div>
                    <div class="form-group mr-2">
                        <label for="figurineHeight">Figurine Image</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="fig_image_file" name="figurineImage">
                            <label class="custom-file-label" id="labelvalue">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="figurinePrice">Figurine Price</label>
                        <input type="text" class="form-control" name="figurinePrice" placeholder="Enter Figurine Price">
                    </div>
                </div>
                <!-- /.card-body -->
                
                
            </div>
            <div class="card card-primary m-3 ">
                <div class="card-header">
                    <h3 class="card-title">Figurine Images</h3>
                </div>
                <div class="card-body d-flex flex-column" id="album_content">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Figure Image File</th>
                            <th>Image Preview</th>
                            <th>Action</th>
                        </tr>
                        <tr>                         
                            <td>
                                <div class="form-group mr-2">
                                    <div class="custom-file w-100 mb-3">
                                        <input type="file" class="custom-file-input" id="fig_image_file" name="figurine[0][file]" onchange="loadFile(event)">
                                        <label class="custom-file-label" id="labelvalue">Choose file</label>
                                    </div>
                                </div>
                            </td>
                            <td><img id='figurineIMG0' height=200 width=200></td>
                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-primary"><i class="right fas fa-plus mr-2"></i>Add Image</button></td>
                        </tr>
                    </table>
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
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><div class="form-group mr-2"><div class="custom-file w-100 mb-3"><input type="file" class="custom-file-input" id="album_file" name="figurine['+i+'][file]"><label class="custom-file-label" for="category_image" id="labelvalue['+i+']">Choose file</label></div></div></td><td><img id="figurineIMG'+i+'" height=200 width=200></td><td><button type="button" class="btn btn-danger remove-input-field">Delete</button></td></tr>');
        
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            //replace the file name from the input field
            $(this).next('.custom-file-label').html(fileName);
            var image = document.getElementById(`figurineIMG${i}`);
            image.src = URL.createObjectURL(event.target.files[0]);


        });
    });

    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });

    var loadFile = function(event) {
        var image = document.getElementById('figurineIMG0');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    

</script>

@endsection