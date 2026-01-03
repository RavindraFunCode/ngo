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

        $currencyCode = $request->input('currency', 'USD');
        $currencySymbol = '$';
        
        $country = \App\Models\Country::where('currency_code', $currencyCode)->first();
        if ($country) {
            $currencySymbol = $country->currency_symbol;
        }

        $data = [
            'amount' => $amount,
            'currency' => $currencyCode,
            'currency_symbol' => $currencySymbol,
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
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'name' => 'required|string',
            'email' => 'required|email',
            'campaign_id' => 'required|exists:campaigns,id',
        ]);

        // Mock payment processing
        $success = true; // Simulate success

        if ($success) {
            $campaign = Campaign::findOrFail($request->input('campaign_id'));

            $donation = new \App\Models\Donation();
            $donation->campaign_id = $campaign->id;
            $donation->amount = $request->input('amount');
            $donation->donor_name = $request->input('name');
            $donation->donor_email = $request->input('email');
            $donation->donor_phone = $request->input('phone');
            $donation->donor_address = $request->input('address');
            $donation->payment_gateway = $request->input('payment_method');
            $donation->currency = $request->input('currency', 'USD');
            $donation->status = 'paid'; // Default status for now
            $donation->paid_at = now();
            $donation->save();

            // Increment raised amount
            $campaign->increment('raised_amount', $donation->amount);

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
