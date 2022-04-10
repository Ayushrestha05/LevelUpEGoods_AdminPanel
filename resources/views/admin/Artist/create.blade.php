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
    <form action="{{ route('admin.artist.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Add new Artist</h3>
            </div>
            <div class="card card-primary m-3 ">
                <div class="card-header">
                    <h3 class="card-title">Artist Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="figurineName">Artist</label>
                        <select name="select_box" id="select_box" class="form-control">
                            <option value=''>Select User</option>
                            @php
                                DB::table('users')->where('is_artist',0)->orderBy('id', 'desc')->get()->each(function($user){
                                    echo "<option value='".$user->id."'>".$user->email."</option>";
                                });
                            @endphp
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label>Artist Image</label>
                        <div class="custom-file w-100 mb-3">
                            <input type="file" class="custom-file-input" id="fig_image_file" name="profileImage">
                            <label class="custom-file-label" id="labelvalue">Choose file</label>
                        </div>
                    </div>                    
                </div>
                <!-- /.card-body -->
                
                
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
@endsection