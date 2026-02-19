<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscribeController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email' // adjust table/rule as needed
        ]);

        // Save the email (e.g., to a 'subscribers' table)
        // Subscriber::create(['email' => $request->email]);

        return response()->json(['message' => 'Thank you for subscribing!']);
    }
}
