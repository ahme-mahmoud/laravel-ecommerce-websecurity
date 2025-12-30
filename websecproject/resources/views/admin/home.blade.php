@extends('admin.home')

@section('content')
<div class="content-wrapper">

    <div class="row g-4">

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="metric-value h3">{{ $total_users }}</p>
                        <p class="metric-title">Total Customers</p>
                    </div>
                    <i class="mdi mdi-account-star text-warning fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="metric-value h3">{{ $total_product }}</p>
                        <p class="metric-title">Total Products</p>
                    </div>
                    <i class="mdi mdi-basket text-info fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="metric-value h3">{{ $total_orders }}</p>
                        <p class="metric-title">Active Orders</p>
                    </div>
                    <i class="mdi mdi-cart text-success fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="metric-value h3">{{ $delivered_orders }}</p>
                        <p class="metric-title">Orders Delivered</p>
                    </div>
                    <i class="mdi mdi-truck-delivery text-danger fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="metric-value h3">{{ $processing_orders }}</p>
                        <p class="metric-title">Orders Processing</p>
                    </div>
                    <i class="mdi mdi-autorenew text-primary fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="metric-value h3">${{ $revenue }}</p>
                        <p class="metric-title">Revenue</p>
                    </div>
                    <i class="mdi mdi-cash-multiple text-success fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="metric-value h3">{{ $sold_products }}</p>
                        <p class="metric-title">Sold Products</p>
                    </div>
                    <i class="mdi mdi-sale text-warning fs-1"></i>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
