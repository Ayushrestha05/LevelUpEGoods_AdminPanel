@extends('layouts.admin')
@section('content')
<div  class="card card-primary m-3 ">
    <div class="card-header">
        <h3 class="card-title">Push Notification</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.bulksend')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label >Title</label>
                <input type="text" class="form-control"  placeholder="Enter Notification Title" name="title">
            </div>
            <div class="form-group">
                <label >Message</label>
                <input type="text" class="form-control"  placeholder="Enter Notification Description" name="body" required>
            </div>
           
            <button type="submit" class="btn btn-primary">Send Notification</button>
        </form>
    </div>
</div>
<script>
    function loadPhoto(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('photo');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection