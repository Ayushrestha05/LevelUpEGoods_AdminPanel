@extends('layouts.admin')
@section('content')
<form action="{{request()->is('admin/orders/pending*') ? route('admin.pending.update',$order_details->id) :  route('admin.completed.update',$order_details->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header d-flex flex-column">
            <div class="col">
                <div class="row" style="margin-left: -5px">
                    <h2 class="mr-2" style="font-weight: bold">Order</h2>
                    <h2 style="color: blue;font-weight:bold">#{{ $order_details->id }}</h2>
                </div>
                <div style="padding: 0px">
                    {{ $order_details->created_at->format('Y F d') }} at
                    {{ $order_details->created_at->format('h:i A') }}
                </div>
            </div>
        </div>
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Reciever Details</h3>
            </div>
            <div class="card-body">
                <div class="col">
                    <div class="row">
                        <label style="margin-right: 10px">Reciever Name:</label>
                        <p>{{ $order_details->reciever_name }}</p>
                    </div>
                    <div class="row">
                        <label style="margin-right: 10px">Reciever City:</label>
                        <p>{{ $order_details->reciever_city }}</p>
                    </div>
                    <div class="row">
                        <label style="margin-right: 10px">Reciever Address:</label>
                        <p>{{ $order_details->reciever_address }}</p>
                    </div>
                    <div class="row">
                        <label style="margin-right: 10px">Reciever Phone:</label>
                        <p>{{ $order_details->reciever_phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Delivery Options</h3>
            </div>
            <div class="card-body">
                <div class="col">
                    <div class="row">
                        <label style="margin-right: 10px">Non-Transparent Bag:</label>
                        <div style="padding-top: 1px">
                            @if ($order_details->hidden == 1)
                                <input type="checkbox" name="hidden" disabled checked>
                            @else
                                <input type="checkbox" name="hidden" disabled >
                            @endif
                        </div>
                        <div class="mr-5"></div>
                        <label style="margin-right: 10px">Gift Wrapped:</label>
                        <div style="padding-top: 1px">
                            @if ($order_details->hidden == 1)
                                <input type="checkbox" name="wrapped" disabled checked>
                            @else
                                <input type="checkbox" name="wrapped" disabled >
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label style="margin-right: 10px">Message Attached:</label>
                    <input type="text" class="form-control" name="name" disabled value="{{ $order_details->sender_message}}">
                </div>
            </div>
        </div>
    
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Order Items</h3>
            </div>
            <div class="card-body">
                <table id="report-question-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Image</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item )
                        <tr>
                            <td>{{ $item->id }}</td>   
                            <td style="width: 120px"><img src="{{ asset('images/items/'.$item->Item->item_image ) }}" height="100px" width="120px"></td>
                            <td>{{ $item->Item->item_name }}</td>             
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->option }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Payment</h3>
            </div>
            <div class="card-body">
                <div class="col">
                    <div class="row">
                        <label style="margin-right: 10px">Amount:</label>
                        <p>Nrs. {{ $order_details->total }}</p>
                    </div>
                    <div class="row">
                        <label style="margin-right: 10px; margin-top:7px">Order Status:</label>
                        {{-- dropdown --}}
                        <div class="form-group">
                            <select class="form-control" name="status" id="status" >
                                <option value="pending" <?php if($order_details->status=="pending") echo 'selected="selected"'; ?>>Pending</option>
                                <option value="completed" <?php if($order_details->status=="completed") echo 'selected="selected"'; ?>>Completed</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection
