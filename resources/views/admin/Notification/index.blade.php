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
                    <h3 class="mb-3">Push Notifications</h3>
                    <a href="{{ route('admin.notifications.create') }}"><button class="btn btn-primary btn-lg" >Add new Notification</button></a>
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Notification Title</th>
                                <th>Notification Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($push_notifications as $notification )
                            <tr>
                                <td>{{ $notification->id}}</td>
                                <td>{{ $notification->title }}</td>
                                <td>{{ $notification->body }}</td>                                
                                <td>
                                    <div class="d-flex">
                                        <form action="{{ route('admin.bulksend') }}" method="POST">
                                            @csrf
                                            <input type="text" class="form-control"  placeholder="Enter Notification ID" name="id" style="display: none" value="{{ $notification->id }}">
                                            <input type="text" class="form-control"  placeholder="Enter Notification Title" name="title" style="display: none" value="{{ $notification->title }}">
                                            <input type="text" class="form-control"  placeholder="Enter Notification Description" name="body" style="display: none" value="{{ $notification->body }}">
                                            <button type="submit" class="btn btn-success mr-3" onclick="return confirm('Are you sure?')"><i class="fas fa-paper-plane"></i></button>
                                        </form>
                                        <div>
                                            <form action="{{ route('admin.notifications.destroy',$notification->id) }}" method="POST">
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