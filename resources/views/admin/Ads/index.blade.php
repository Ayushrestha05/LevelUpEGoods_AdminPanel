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
                    <h3 class="mb-3">Ads</h3>
                    <a href="{{ route('admin.ads.create') }}"><button class="btn btn-primary btn-lg" >Add new AD</button></a>
                
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Active</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ads as $ad )
                            <tr>
                                <td>{{ $ad->id }}</td>
                                <td>{{ $ad->title }}</td>
                                <td>{{ $ad->description }}</td>
                                <td>{{ $ad->active }}</td>
                            
                                <td>
                                    <div class="d-flex">
                                        <div class="mr-1">
                                            <a href="{{ route('admin.ads.show',$ad->id) }}"><button class="btn btn-secondary"><i class="fas fa-eye"></i></button></a>
                                        </div>
                                        <div class="mr-1">
                                            <a href="{{ route('admin.ads.edit',$ad->id) }}"><button class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('admin.ads.destroy',$ad->id) }}" method="POST">
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