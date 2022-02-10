@extends('layouts.admin')

@section('content')
<div class="float-right mr-3 mt-2">
    <a href="{{ route('admin.report-question.index') }}"><h5><b>&lt; Back</h5></b></a>
</div>
<div class="col mt-1 d-flex flex-column">
    <div class="card card-primary ">
        <div class="card-header">
          <h3 class="card-title">New Question Type</h3>
        </div>
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
        <form action="{{ route('admin.report-question.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Question</label>
                    <input type="text" class="form-control" name="question_type" placeholder="Enter Question">
                </div>
            </div>
          <!-- /.card-body -->
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
</div>
@endsection