@extends('master')

@section('content')
<div class="container cartlist mt-3">
    <h3>Check Out</h3>
    <div class="row">
        <div class="col-md-9">
            <table class="table table-striped table-inverse table-responsive">
                <thead class="">
                    <tr>
                        <th>Amount</th>
                        <th>Tax</th>
                        <th>Delivery</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">{{$total}}</td>
                        <td>$10</td>
                        <td>0</td>
                        <td>{{$total + 10}}</td>
                    </tr>
                </tbody>
            </table>
            <form action="{{ route('pay') }}" role="form" accept-charset="UTF-8" method="POST">
                @csrf
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" readonly class="form-control" value="{{$user_data['first_name']}}"
                        name="first_name">
                    <label for="lastname">Last Name</label>
                    <input type="text" readonly class="form-control" value="{{$user_data['last_name']}}"
                        name="last_name">
                    <label for="number">Phone</label>
                    <input type="number" class="form-control" name="phone" value="{{$user_data['phone']}}">
                    <label for="address">Address</label>
                    <textarea class="form-control" required readonly name="address" id=""
                        rows="3">{{$user_data['address']}}</textarea>
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$user_data['email']}}">
                    <input type="hidden" name="orderID" value="345.00">
                    <input type="hidden" name="amount" value="{{$total}}.00">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="currency" value="NGN">
                    @foreach ($products as $product)
                    <input type="hidden" name="metadata"
                        value="{{ json_encode($array = ['email' =>$user_data['email'],
                        'first_name' => $user_data['first_name'],'last_name' => $user_data['last_name'],
                        'user_id'=>$user_data['id'],'product_id'=>$product->id, 'quantity'=> '1', 'address' =>
                        $user_data['address']]) }}">
                    @endforeach
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3 btn-sm">Order Now</button>
            </form>
        </div>
    </div>
</div>
@endsection
