<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $query = Country::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $countries = $query->orderBy('is_active', 'desc')->orderBy('name', 'asc')->paginate(15);
        return view('admin.countries.index', compact('countries'));
    }

    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'iso' => 'required|string|size:2|unique:countries,iso',
            'iso3' => 'nullable|string|size:3',
            'numcode' => 'nullable|integer',
            'phonecode' => 'required|string',
            'currency_code' => 'required|string|size:3',
            'currency_symbol' => 'required|string',
            'min_phone_length' => 'required|integer',
            'max_phone_length' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        Country::create([
            'name' => $request->name,
            'iso' => strtoupper($request->iso),
            'iso3' => $request->iso3 ? strtoupper($request->iso3) : null,
            'numcode' => $request->numcode,
            'phonecode' => $request->phonecode,
            'currency_code' => strtoupper($request->currency_code),
            'currency_symbol' => $request->currency_symbol,
            'min_phone_length' => $request->min_phone_length,
            'max_phone_length' => $request->max_phone_length,
            'is_active' => $request->has('is_active'),
        ]);

        return response()->json(['status' => true, 'message' => 'Country created successfully.']);
    }

    public function edit(Country $country)
    {
        return response()->json(['status' => true, 'data' => $country]);
    }

    public function update(Request $request, Country $country)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'iso' => 'required|string|size:2|unique:countries,iso,' . $country->id,
            'iso3' => 'nullable|string|size:3',
            'numcode' => 'nullable|integer',
            'phonecode' => 'required|string',
            'currency_code' => 'required|string|size:3',
            'currency_symbol' => 'required|string',
            'min_phone_length' => 'required|integer',
            'max_phone_length' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        $country->update([
            'name' => $request->name,
            'iso' => strtoupper($request->iso),
            'iso3' => $request->iso3 ? strtoupper($request->iso3) : null,
            'numcode' => $request->numcode,
            'phonecode' => $request->phonecode,
            'currency_code' => strtoupper($request->currency_code),
            'currency_symbol' => $request->currency_symbol,
            'min_phone_length' => $request->min_phone_length,
            'max_phone_length' => $request->max_phone_length,
            'is_active' => $request->has('is_active'),
        ]);

        return response()->json(['status' => true, 'message' => 'Country updated successfully.']);
    }

    public function destroy(Country $country)
    {
        try {
            $country->delete();
            return response()->json(['status' => true, 'message' => 'Country deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to delete country. Error: ' . $e->getMessage()]);
        }
    }
}
