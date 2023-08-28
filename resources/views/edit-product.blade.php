@extends('admin-master')

@section('manage_products')
<div class="dashboard-wrapper">

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">E-commerce Dashboard</h2>
                        @if (Session::has('success'))
                           <div class="alert alert-success mt-4">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @php
                         Session::forget('success')
                        @endphp
                        @if(Session::has('error'))
                            <div class="alert alert-danger mt-4">
                                {{Session::get('error')}}
                            </div>
                        @endif
                        @php
                            Session::forget('error')
                        @endphp
                        <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <!-- ... (rest of your code) ... -->
                    </div>
                </div>
                <div class="row">
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->

                                  <!-- products  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Edit Products</h5>
                            <div class="card-body p-3">
                                <form action="/update-product" class="form-group" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" value="{{$product['name']}}" required name="name"> <br>
                                    <!-- ... (rest of your form fields) ... -->
                                    <button type="submit" name="edit-product" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end edit products  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
