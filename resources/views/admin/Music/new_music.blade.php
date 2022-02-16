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
    <form action="{{ route('admin.music.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Add new Music</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Album Description</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="album_name">Album Name</label>
                        <input type="text" class="form-control" name="album_name" placeholder="Enter Album's Name">
                    </div>
                    <div class="form-group">
                        <label for="album_artist">Album Artist</label>
                        <input type="text" class="form-control" name="album_artist" placeholder="Enter Album's Artist(s)">
                    </div>
                </div>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Album Details</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <!--Data Entry Column-->
                        <div class="d-flex flex-column w-75 mr-2">
                            <div class="form-group">
                                <label for="album_name">Album Type</label>
                                <select class="custom-select rounded-0" name="album_type">
                                    <option value="">Choose...</option>
                                    <option value="Single">Single</option>
                                    <option value="EP">EP</option>
                                    <option value="Album">Album</option>
                                    <option value="Remix">Remix</option>
                                </select>
                            </div>
                            <div class="input-group d-flex flex-column">
                                <label>Album Image</label>
                                <div class="custom-file w-100 mb-3">
                                    <input type="file" class="custom-file-input" id="album_image" name='album_image' onchange="loadFile(event)">
                                    <label class="custom-file-label" for="album_image" id='labelvalue'>Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="album_artist">Digital Price</label>
                                <input type="text" class="form-control" name="digital_price" placeholder="Enter the Album's Digital Price">
                            </div>
                            <div class="form-group">
                                <label for="album_artist">Physical Price</label>
                                <input type="text" class="form-control" name="physical_price" placeholder="Enter the Album's Physical Price">
                            </div>
                        </div>
                        <!--Preview Column-->
                        <div class="d-flex flex-column justify-content-end w-25">
                            <img src="https://static.wikia.nocookie.net/c98c13ff-899b-47a3-9225-1f4a915fb493" height="200px" width="200px">
                            <p>Album Name</p>
                            <p>NPR 3000</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Album Contents</h3>
                </div>
                <div class="card-body d-flex flex-column" id="album_content">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Track Name</th>
                            <th>Track Time</th>
                            <th>Track File</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="album[0][name]" placeholder="Enter Track Name"></td>
                            <td><input type="text" class="form-control" name="album[0][time]" placeholder="Enter Track Time (MM:SS)"></td>
                            <td>
                                <div class="form-group mr-2">
                                    <div class="custom-file w-100 mb-3">
                                        <input type="file" class="custom-file-input" id="album_file" name="album[0][file]">
                                        <label class="custom-file-label" for="category_image" id="labelvalue">Choose file</label>
                                    </div>
                                </div>
                            </td>
                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-primary"><i class="right fas fa-plus mr-2"></i>Add Track</button></td>
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
        $("#dynamicAddRemove").append('<tr><td><input type="text" class="form-control" name="album['+i+'][name]" placeholder="Enter Track Name"></td><td><input type="text" class="form-control" name="album['+i+'][time]" placeholder="Enter Track Time (MM:SS)"></td><td><div class="form-group mr-2"><div class="custom-file w-100 mb-3"><input type="file" class="custom-file-input" id="album_file" name="album['+i+'][file]"><label class="custom-file-label" for="category_image" id="labelvalue">Choose file</label></div></div></td><td><button type="button" class="btn btn-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection