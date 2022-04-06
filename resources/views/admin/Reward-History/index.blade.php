@extends('layouts.admin')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success m-2">
    <p>{{ $message }}</p>
</div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex flex-column">
                    <h3 class="mb-3">Reward History</h3>
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Item Image</th>
                                <th>Reward Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reward_history as $item )
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->User->name}}</td>
                                <td style="width: 100px"><img src={{ asset('images/reward-items/'.$item->RewardItem->item_image) }} height=100 width=100 style="object-fit:scale-down;"></td>
                                <td>{{ $item->RewardItem->item_name }}</td>                                
                                <td>{{ $item->status }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="mr-1">
                                            <a href="{{ route('admin.reward-history.edit',$item->id) }}"><button class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('admin.reward-history.destroy',$item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection