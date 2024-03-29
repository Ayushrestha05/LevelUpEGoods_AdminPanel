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
                    <h3 class="mb-3">Platforms</h3>
                    <a href="{{ route('admin.platforms.create') }}"><button class="btn btn-primary btn-lg" >Add new Platform</button></a>
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Platform Name</th>
                                <th>Platform Family</th>
                                <th>Platform Icon</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($platforms as $platform )
                            <tr>
                                <td>{{ $platform->id}}</td>
                                <td>{{ $platform->name }}</td>
                                <td>{{ $platform->platform_family }}</td>
                                <td><img src={{ asset('images/platforms/'.$platform->icon_filename) }} height=100 width=100 style="object-fit:scale-down;"></td>
                                <td>
                                    <div class="d-flex">
                                        <div>
                                            <form action="{{ route('admin.platforms.destroy',$platform->id) }}" method="POST">
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