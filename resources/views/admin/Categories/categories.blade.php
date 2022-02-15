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
                    <h3 class="mb-3">Categories</h3>
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Color</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category )
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                @if ($category->category_image != null)
                                    <td><img src="{{ asset('images/categories/'.$category->category_image) }}" width="300px" height="150px"></td>  
                                @else
                                <td></td>
                                @endif
                                <td>
                                    <div class="d-flex">
                                        <p>{{ $category->category_color }}</p>
                                    <div class="ml-1" style="background: {{ $category->category_color }}; height:20px;width:20px"></div>
                                
                                    </div>
                                </td>
                                <td>
                                    <div class="mr-1">
                                        <a href="{{ route('admin.categories.edit',$category->id) }}"><button class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button></a>
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