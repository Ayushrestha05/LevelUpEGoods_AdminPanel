@extends('layouts.admin')

@section('content')
    <div class="p-3">
        <div class="ml-2"> 
          <h2>{{ date('F j, Y') }}</h2>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          
                  <div class="info-box-content">
                    <span class="info-box-text">New Members this Month</span>
                    <span class="info-box-number">{{ $newUsers }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
          
                  <div class="info-box-content">
                    <span class="info-box-text">Total Items Sold This Month</span>
                    <span class="info-box-number">{{ $totalItemsSold }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill"></i></span>
        
                <div class="info-box-content">
                  <span class="info-box-text">Total Revenue Collected This Month</span>
                  <span class="info-box-number">
                    NPR {{ $totalRevenue }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-info"></i></span>
        
                <div class="info-box-content">
                  <span class="info-box-text">Total Reports</span>
                  <span class="info-box-number">{{ $totalReports }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
        
        
           
            
          </div>
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Top Selling Products</h3>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                  <th>Product</th>
                  <th>Option</th>
                  
                  <th>Sales</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach ($topSellingItems as $topItem)
                  <tr>
                    <td>
                      <img src="{{ asset('images/items/'.$topItem->item_image) }}" alt="Product 1" class="img img-size-64 mr-2">
                      {{ $topItem->item_name }}
                    </td>
                    <td>{{ $topItem->option }}</td>
                    
                    <td>                    
                      {{ $topItem->sales }} Sold
                    </td>                  
                  </tr>
                @endforeach
                
                </tbody>
              </table>
            </div>
          </div>
    </div>
@endsection
