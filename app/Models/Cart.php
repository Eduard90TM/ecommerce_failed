<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Get the total price of all products in the cart
    public function getTotalPrice()
    {
        return $this->product->price; // You can modify this to consider quantities and other factors
    }

    // Remove a product from the cart
    public function removeFromCart()
    {
        $this->delete();
        // You might want to update the user's cart count or other relevant data here
    }
}
