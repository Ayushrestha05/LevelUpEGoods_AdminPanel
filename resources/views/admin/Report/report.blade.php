@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column">
                        <h3 class="mb-3">User Reports</h3>
                    </div>
                    
                    <div class="card-body">
                        <table id="report-question-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Report Category</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report )
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ $report->user_id }}</td>
                                    <td>{{ $report->report_category }}</td>  
                                    <td>{{ $report->title }}</td>
                                    <td>
                                        <div class="mr-1">
                                            <a href="{{ route('admin.user-reports.edit',$report->id) }}"><button class="btn btn-secondary"><i class="fas fa-eye"></i></button></a>
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