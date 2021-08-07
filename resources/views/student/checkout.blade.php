@extends('layouts.master')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Checkout</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <form action="{{ route('user.complete_payment') }}" method="POST">
            @csrf

            <input type="hidden" name="course_id" value="{{ $course['id'] }}">
            <div class="card">
                <div class="card-header">
                    <h3>Checkout</h3>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Name On Card</label>
                                <input type="text" class="form-control" name="name" placeholder="Name On Card"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control" name="card_number" placeholder="Card Number"
                                    value="{{ old('card_number') }}">
                                @error('card_number')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>MM / YY</label>
                                    <input type="text" class="form-control" name="month_year" placeholder="MM / YY"
                                        value="{{ old('month_year') }}">
                                    @error('month_year')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Security Code</label>
                                    <input type="text" class="form-control" name="security_code" placeholder="Security Code"
                                        value="{{ old('security_code') }}">
                                    @error('security_code')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Zip/Postal Code</label>
                                    <input type="text" class="form-control" name="zip_code" placeholder="Zip/Postal Code"
                                        value="{{ old('zip_code') }}">
                                    @error('zip_code')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="font-weight-bold">Order Details</h3>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Subject</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $course['name'] }}</td>
                                        <td>{{ $course['subject'] }}</td>
                                        <td>{{ number_format($course['price']) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button type="submit" class="btn btn-primary btn-block">Complete Payment</button>
                </div>
            </div>
        </form>
    @endsection
    @push('scripts')
        <script>
        </script>
    @endpush
