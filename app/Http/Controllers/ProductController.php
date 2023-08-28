<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response; // Import Response facade
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // ... Other methods ...

    public function index()
    {
        $products = Product::all();
        return view('home', ['products' => $products]);
    }

    public function product($id)
    {
        $product = Product::find($id);
        return view('products', ['product' => $product]);
    }

    public function cart(Request $request)
    {
        // ... Cart method implementation ...
    }

    // ... Other methods ...

    public function searchProducts(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'like', '%' . $search . '%')->get();
        return view('search', ['products' => $products]);
    }

    public function checkout()
    {
        // ... Checkout method implementation ...
    }

    // ... Other methods ...

    public function addCategory(Request $request)
    {
        $category = new Category;
        $category->name = ucfirst($request->name);

        if ($category->save()) {
            return Response::json(['code' => 'success', 'msg' => 'Category added successfully']);
        } else {
            return Response::json(['code' => 'danger', 'msg' => 'Error adding category']);
        }
    }

    // ... Other methods ...

    public function showProduct($id)
    {
        $product = Product::find($id);
        return view('edit-product', ['product' => $product]);
    }

    // ... Other methods ...

    public function updateOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->delivery_status = $request->status;

        if ($order->save()) {
            return Response::json(['code' => 'success', 'msg' => 'Order status updated']);
        } else {
            return Response::json(['code' => 'danger', 'msg' => 'Error updating order status']);
        }
    }

    public function cartNum()
    {
        if (Session::has('user')) {
            $user_id = Session::get('user')['id'];
            $cart_count = Cart::where('user_id', $user_id)->count();
            return $cart_count;
        }

        return 0;
    }
    public function header()
{
    $total_items = 0;
    if (Session::has('user')) {
        $user_id = Session::get('user')['id'];
        $total_items = $this->cartNum($user_id);
    }

    return view('header', ['total_items' => $total_items]);
}


}
