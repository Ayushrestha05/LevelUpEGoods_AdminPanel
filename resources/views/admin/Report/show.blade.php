@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card card-primary m-3">
            <div class="card-header">
                <h3 class="card-title">Report Details</h3>
            </div>
            <div class="card-body">
                <div class="col">
                    
                    <label style="margin-right: 10px">Reporting User Name:</label>
                    <p>{{ $report->user->name }}</p>
                    <label style="margin-right: 10px">Reporting User Email:</label>
                    <p>{{ $report->user->email }}</p>
                    <label style="margin-right: 10px">Report Title:</label>
                    <p>{{ $report->title }}</p>
                    <label style="margin-right: 10px">Report Description:</label>
                    <p>{{ $report->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection