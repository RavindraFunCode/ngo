<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('campaign')->latest()->paginate(20);
        return view('admin.donations.index', compact('donations'));
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }
}
