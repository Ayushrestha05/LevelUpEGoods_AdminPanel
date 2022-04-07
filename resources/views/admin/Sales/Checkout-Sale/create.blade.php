@extends('layouts.admin')
@section('content')
<div class="float-right mr-3 mt-2">
    <a href="{{ route('admin.checkout.index') }}"><h5><b>&lt; Back</h5></b></a>
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
    <form action="{{ route('admin.checkout.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Create Checkout Sale</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Sale Description</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Sale Title</label>
                        <input type="text" class="form-control" name="sale_title" placeholder="Enter Sale Title">
                    </div>
                    <div class="form-group">
                        <label>Discount Percent</label>
                        <input type="text" class="form-control" name="discount_percent" placeholder="Enter the Discount Percent applied">
                    </div>
                    <div class="form-group">
                        <label>Amount Required</label>
                        <input type="text" class="form-control" name="amount_required" placeholder="Enter the Amount Required to activate the discount">
                    </div>
                    <div class="form-group">
                        <label>Amount Required</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
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