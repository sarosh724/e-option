@extends('admin.templates.index')

@section('page-title')
    Dashboard
@stop

@section('title')
    Dashboard
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12 col-md-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>0{{@$dashboardData['completed_orders']}}</h3>

                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-xs-12 col-md-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0{{@$dashboardData['today_orders']}}</h3>

                    <p>Pending Pending Deposits</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-xs-12 col-md-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>0{{@$dashboardData['products']}}</h3>

                    <p>Completed Withdrawals</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cube"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-xs-12 col-md-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>0{{@$dashboardData['customers']}}</h3>

                    <p>Completed Deposits</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
@stop


