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
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @php
                            Session::forget('success')
                        @endphp
                        @if (Session::has('error'))
                            <div class="alert alert-danger mt-4">
                                {{ Session::get('error') }}
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
                                    <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            @include('layouts.order_details')

            <div class="row">
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- products  -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Manage Products</h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0">#</th>
                                            <th class="border-0">Image</th>
                                            <th class="border-0">Product Name</th>
                                            <th class="border-0">Product Id</th>
                                            <th class="border-0">Quantity</th>
                                            <th class="border-0">Price</th>
                                            <th class="border-0">Category</th>
                                            <th class="border-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($products as $product)
                                            <tr class="delete_row">
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <div class="m-r-10"><img src="{{ url('assets/images/'.$product['gallery']) }}" alt="product" class="rounded" width="45"></div>
                                                </td>
                                                <td>{{ $product['name'] }}</td>
                                                <td>{{ $product['product_id'] }}</td>
                                                <td>{{ $product['quantity'] }}</td>
                                                <td>{{ $product['price'] }}</td>
                                                <td>{{ $product['category'] }}</td>
                                                <td style="display:flex;" class="my-2">
                                                    <a href="/edit-product/{{ $product['id'] }}">
                                                        <i class="fas fa-edit mr-2 text-primary"></i>
                                                    </a>
                                                    <form action="{{ route('delete.prd') }}" method="post" id="submit">
                                                        @csrf
                                                        <input type="hidden" class="prd_id" name="prd_id" value="{{ $product['id'] }}">
                                                        <button style="background: none;border:none;" onclick="delete_product(this)" type="button" class="delete_cat" >
                                                            <i class="fas fa-trash mr-2 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end manage products -->
            </div>

            <!-- edit product Modal -->
            <div class="modal fade" id="edit-product" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <!-- ... Modal content ... -->
            </div>

            <!-- add new product Modal -->
            <div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <!-- ... Modal content ... -->
            </div>
        </div>
    </div>
</div>
@endsection
