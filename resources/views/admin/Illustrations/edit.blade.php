@extends('layouts.admin')

@section('content')
<div class="float-right mr-3 mt-2">
    <a href="{{ route('admin.illustrations.index') }}"><h5><b>&lt; Back</h5></b></a>
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
    <form action="{{ route('admin.illustrations.update',$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Edit Existing Illustration</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Illustration Description</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="album_name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Illustration's Name" value="{{ $item->item_name }}">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Description</label>
                        <textarea class='form-control' name="description" rows="3" placeholder="Enter Illustration's Description">{{ $item->item_description }}</textarea>
                    </div>
                    <div class="input-group d-flex flex-column">
                        <label>Illustration Image</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="image" name='image' onchange="loadFile(event)">
                            <label class="custom-file-label" for="image" id='labelvalue'>{{ $item->item_image }}</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" >
                        <img height="200" width="400" style="object-fit:scale-down;display:none" id="uploadImage">
                    </div>
                    <div class="form-group"
                    >
                        <label>Illustration Creator</label>
                        <div class="d-flex flex-row">
                            @if ($illustrations->user_id != null)
                                <p>{{ $illustrations->User->name }}</p>
                            @elseif ($illustrations->creator != null)   
                                <p>{{ $illustrations->creator }}</p> 
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Illustration Prices</h3>
                </div>
                <div class="card-body d-flex flex-column" id="album_content">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @for ($i=0; $i < count($illustration_prices); $i++)
                            <tr>
                                <td><input type="text" class="form-control" name="illustration[{{ $i }}][size]" placeholder="Enter Size" value="{{ $illustration_prices[$i]->size }}" disabled></td>
                                <td><input type="text" class="form-control" name="illustration[{{ $i }}][price]" placeholder="Enter Price" value="{{ $illustration_prices[$i]->price }}"></td>
                                @if ($i == count($illustration_prices)-1)
                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-primary"><i class="right fas fa-plus mr-2"></i>Add Price</button></td>
                            @endif
                            </tr>                            
                        @endfor
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
{{-- Enabling Select2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script>
    $(document).ready(function() {
      $('#select_box').select2({
        theme: 'bootstrap4',
        placeholder: "Select User",
        width : '100%'
      });
      
   });
</script>

{{-- Dynamic Add/Remove --}}
<script type="text/javascript">
    var i = count($illustration_prices);
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" class="form-control" name="illustration['+i+'][size]" placeholder="Enter Size"></td><td><input type="text" class="form-control" name="illustration['+i+'][price]" placeholder="Enter Price"></td><td><button type="button" class="btn btn-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>

{{-- Script to display image on upload --}}
<script>
    function loadFile(event) {
        var output = document.getElementById('uploadImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.style.display = 'block';
    }

    function onChangeRadio(event) {
        if (event.target.value == 'user') {
            $('#userBlock').show();
            $('#nameBlock').hide();
        } else {
            $('#userBlock').hide();
            //When changed to Name revert value to null;
            $('#select_box').val(null).trigger('change');
            $('#nameBlock').show();
        }
    }
</script>


@endsection