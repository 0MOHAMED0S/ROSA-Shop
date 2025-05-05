@extends('layouts.master')
@section('content')
    <!-- Bread crumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Send Email For All Users</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('dashboard.sections.create') }}">Add New</a>
                            </li>
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
        <!-- Start Page Content -->
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Send Email</h5>
                        <form action="{{ route('dashboard.send.message') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="subject" class="form-label">Email Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    id="subject" name="subject" placeholder="Enter email subject"
                                    value="{{ old('subject') }}" required>

                                @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Email Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="6"
                                    placeholder="Write your message here..." required>{{ old('message') }}</textarea>

                                @error('message')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Send Email to All Users</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Content -->

    </div>
    <!-- End Container fluid -->
@endsection
