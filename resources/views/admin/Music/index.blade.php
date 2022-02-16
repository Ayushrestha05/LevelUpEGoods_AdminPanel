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
                    <h3 class="mb-3">Music Items</h3>
                    <a href="{{ route('admin.music.create') }}"><button class="btn btn-primary btn-lg" >Add new Music Item</button></a>
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Album Name</th>
                                <th>Album Type</th>
                                <th>Digital Price</th>
                                <th>Physical Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($music_items as $item )
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->Music->music_type }}</td>
                                <td>NPR {{ $item->Music->digital_price }}</td>
                                <td>NPR {{ $item->Music->physical_price}}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="mr-1">
                                            <a href="{{ route('admin.music.show',$item->id) }}"><button class="btn btn-secondary"><i class="fas fa-eye"></i></button></a>
                                        </div>
                                        <div class="mr-1">
                                            <a href="{{ route('admin.music.edit',$item->id) }}"><button class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('admin.music.destroy',$item->id) }}" method="POST">
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