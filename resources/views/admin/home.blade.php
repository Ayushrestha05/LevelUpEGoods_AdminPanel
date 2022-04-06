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
    </div>
@endsection
