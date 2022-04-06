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
    <form action="{{ route('admin.reward-history.update',$reward_history->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex flex-column">
                <h3>Edit Existing Reward History</h3>
            </div>
            <div class="card card-primary m-3">
                <div class="card-header">
                    <h3 class="card-title">Reward History Details</h3>
                </div>
                <div class="card-body">
                    <label>Item Name</label>
                    <p>{{ $reward_history->RewardItem->item_name }}</p>
                    <label> Redeemed by User</label>
                    <p>{{ $reward_history->User->name}}</p>
                    <label> Redeemed On</label>
                    <p>{{ $reward_history->created_at->format('d-F-Y')}}</p>
                    <label> Status</label>
                    <select class="form-control" name="status" id="status" >
                        <option value="pending" <?php if($reward_history->status=="pending") echo 'selected="selected"'; ?>>Pending</option>
                        <option value="completed" <?php if($reward_history->status=="completed") echo 'selected="selected"'; ?>>Completed</option>
                    </select>
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