<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    public function add(Request $request) {
        // Validate the incoming request data
        $validated = $request->validate([
           'amount' => 'required|numeric|min:1',
           'email' => 'required|email',
       ]);

       // Set your secret key. Remember to switch to your live secret key in production!
       Stripe::setApiKey(env('STRIPE_SECRET'));

       // Create a new Checkout Session
       $session = StripeSession::create([
           'payment_method_types' => ['card'],
           'line_items' => [[
               'price_data' => [
                   'currency' => 'usd',
                   'product_data' => [
                       'name' => 'Product Name', // You can replace this with dynamic data
                   ],
                   'unit_amount' => $validated['amount'] * 100, // Amount in cents
               ],
               'quantity' => 1,
           ]],
           'customer_email' => $validated['email'],
           'mode' => 'payment',
           'success_url' => env('FRONTEND_URL').env('FRONTEND_SUCCESS_URL'),
           'cancel_url' => env('FRONTEND_URL').env('FRONTEND_FAILURE_URL'), // You should define this route
       ]);

       // Return the session ID for redirect
       return response()->json(['id' => $session->id]);
   }
}