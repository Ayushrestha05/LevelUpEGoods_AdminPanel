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
                    <h3 class="mb-3">Report Questions</h3>
                    <a href="{{ route('admin.report-question.create') }}"><button class="btn btn-primary" style="width:200px">Create a Question</button></a>
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_questions as $question )
                            <tr>
                                <td>{{ $question->id}}</td>
                                <td>{{ $question->question }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.report-question.edit',$question->id) }}"><button class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button></a>
                                        <form action="{{ route('admin.report-question.destroy',$question->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                                        </form>
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