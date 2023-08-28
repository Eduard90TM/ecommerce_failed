@php
    use App\Http\Controllers\ProductController;
    use Illuminate\Support\Facades\Session;

    $total_items = 0;
    if (Session::has('user')) {
        $productController = new ProductController();
        $user_id = Session::get('user')['id'];
        $total_items = $productController->cartNum($user_id);
    }
@endphp

<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <!-- Rest of your navigation code -->

    <button class="btn">
        <a href="/cartlist" style="text-decoration:none;">
            <span class="text-light">Cart</span>
            <span class="badge badge-pill total_items badge-warning">{{$total_items}}</span>
        </a>
    </button>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchCartCount() {
        $.ajax({
            url: '/cart/count',
            type: 'GET',
            success: function(response) {
                $('.total_items').text(response.cart_count);
            },
            error: function() {
                console.log('Error fetching cart count.');
            }
        });
    }

    fetchCartCount();
</script>
