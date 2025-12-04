<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class DonationController extends Controller
{
    public function checkout(Request $request)
    {
        $amount = $request->input('amount');
        if ($request->has('custom_amount') && !empty($request->input('custom_amount'))) {
            $amount = $request->input('custom_amount');
        }

        $data = [
            'amount' => $amount,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'payment_method' => $request->input('payment_method'),
        ];

        return view('website.donation.checkout', compact('data'));
    }

    public function process(Request $request)
    {
        // Mock payment processing
        $success = true; // Simulate success

        if ($success) {
            // Logic to save donation to database would go here
            return redirect()->route('donation.thank-you');
        } else {
            return redirect()->route('donation.failed');
        }
    }

    public function thankYou()
    {
        return view('website.donation.thank-you');
    }

    public function failed()
    {
        return view('website.donation.failed');
    }
}
