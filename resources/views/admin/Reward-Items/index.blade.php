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
                    <h3 class="mb-3">Reward Items</h3>
                    <a href="{{ route('admin.reward-items.create') }}"><button class="btn btn-primary btn-lg" >Add new Reward Item</button></a>
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>Item Image</th>
                                <th>Reward Points Required</th>
                                <th>Stock Left</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reward_items as $item )
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->item_name }}</td>
                                <td style="width: 100px"><img src={{ asset('images/reward-items/'.$item->item_image) }} height=100 width=100 style="object-fit:scale-down;"></td>
                                <td>{{ $item->reward_points }}</td>                                
                                <td>{{ $item->stock }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="mr-1">
                                            <a href="{{ route('admin.reward-items.edit',$item->id) }}"><button class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('admin.reward-items.destroy',$item->id) }}" method="POST">
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