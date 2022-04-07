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
                    <h3 class="mb-3">Checkout Sales</h3>
                    <a href="{{ route('admin.checkout.create') }}"><button class="btn btn-primary btn-lg" >Add new Checkout Sale</button></a>
                </div>
                
                <div class="card-body">
                    <table id="report-question-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sale Title</th>
                                <th>Discount Percent</th>
                                <th>Amount Required</th>
                                <th>Active</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkoutSales as $sale )
                            <tr>
                                <td>{{ $sale->id}}</td>
                                <td>{{ $sale->sale_title }}</td>
                                <td>{{ $sale->discount_percent }}</td>                                
                                <td>{{ $sale->amount_required }}</td>
                                <td>{{ $sale->is_active }}</td>
                                <td>{{ $sale->created_at->format('d-F-Y') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="mr-1">
                                            <a href="{{ route('admin.checkout.edit',$sale->id) }}"><button class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('admin.checkout.destroy',$sale->id) }}" method="POST">
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