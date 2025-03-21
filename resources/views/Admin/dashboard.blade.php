@extends('layouts.master')

@section('content')
    <!-- Bread crumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('dashboard.products.create') }}">Add New</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bread crumb -->

    <!-- Container fluid -->
    <div class="container-fluid">
        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Dashboard Cards -->
        <div class="row">

            <!-- Sections Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Sections</h5>
                        <p class="card-text">Total Sections: {{ $sectionCount }}</p>
                        <a href="{{ route('dashboard.sections.index') }}" class="btn btn-light">View Sections</a>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Total Users: {{ $userCount }}</p>
                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-light">View Sections</a>
                    </div>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Orders</h5>
                        <p class="card-text">Total Orders: {{ $orderCount }}</p>
                        <a href="{{ route('dashboard.orders.index') }}" class="btn btn-light">View Orders</a>
                    </div>
                </div>
            </div>

            <!-- Products Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">Total Products: {{ $productCount }}</p>
                        <a href="{{ route('dashboard.products.index') }}" class="btn btn-light">View Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container fluid -->
@endsection
