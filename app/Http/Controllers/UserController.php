<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View; // Import the View facade

class UserController extends Controller
{
    // register functionality
    public function register(Request $req)
    {
        // Validate registration
        $validatedData = $req->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'phone' => 'required|min:10',
            // 'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048' image upload functionality
        ]);

        // Create a new User instance
        $user = User::create([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'address' => $req->address,
            'email' => $req->email,
            'phone' => $req->phone,
            'password' => Hash::make($req->password),
        ]);

        return back()->with('success', 'Signed up successfully');
    }

    // login functionality
    public function login(Request $req)
    {
        // Validate login
        $validatedData = $req->validate([
            'email' => 'required|max:150',
            'password' => 'required',
        ]);

        // Retrieve user data by email
        $user = User::where('email', $req->email)->first();

        if ($user && Hash::check($req->password, $user->password)) {
            // Store user data in session
            $req->session()->put('user', $user);

            return redirect('/');
        } else {
            return back()->with('failure', 'Incorrect email or password');
        }
    }

    // user data
    public function user_data()
    {
        // Retrieve user ID from session
        $user_id = Session::get('user')['id'];

        // Retrieve user data by ID
        $user_data = User::find($user_id);

        // Handle null user data
        if (!$user_data) {
            // You can redirect the user to an error page or handle it as needed
            return redirect('/error');
        }

        // Return user data to view
        return view("profile", ['user_data' => $user_data]);
    }
}
