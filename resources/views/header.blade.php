@php
    use Illuminate\Support\Facades\Session;
    use App\Http\Controllers\ProductController;
    {{$total_items}} = 0;
    if (Session()->has('user')) {
        // Use the session user ID to fetch the cart count
        {{$user_id}} = Session()->get('user')['id'];
        {{$total_items}} = ProductController::cartNum($user_id);
    }
@endphp




<!DOCTYPE html>
<html>
<head>
    <title>E-commerce Website</title>

<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <a class="navbar-brand" href="#">E-commerce</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/orderlist">Orders</a>
            </li>
            <form class="form-inline my-2 my-lg-0" action="/search">
                <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search">
                <button class="btn btn-outline-success text-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </ul>
    </head>
  <body>
     <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <a class="navbar-brand" href="#">E-commerce</a>

        <ul class="nav nav-tabs nav-primary">
            @if(Session::has('user'))
            <li class="nav-item dropdown bg-light" style="border-radius: 10px;border:none;outline:none;">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                 role="button" aria-haspopup="true" aria-expanded="false">{{Session::get('user')['first_name']}}</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item"  href="/logout">logout</a>
                    <a class="dropdown-item"  href="/profile">profile</a>
                </div>
            </li>
            @else
            <li class="nav-link redirect-links"><a href="/login">login</a></li>
            <li class="nav-link redirect-links"><a href="/register">register</a></li>
            @endif
        </ul>
        <button class="btn">
            <a href="/cartlist" style="text-decoration:none;">
                <span class="text-light">Cart</span>
                <span class="badge badge-pill total_items badge-warning" id="cartCountBadge">Loading...</span>
            </a>
        </button>
    </nav>

    <script>
        // Function to fetch cart count using Ajax
        function fetchCartCount() {
            $.ajax({
                url: '/cart/count', // Change this URL to your actual route
                type: 'GET',
                success: function(response) {
                    $('#cartCountBadge').text(response.cart_count);
                },
                error: function() {
                    console.log('Error fetching cart count.');
                }
            });
        }

        // Call the function initially
        fetchCartCount();
    </script>
    </nav>
    </div>
</nav>


</body>
</html>









