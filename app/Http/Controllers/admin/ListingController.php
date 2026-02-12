<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ListingController extends Controller
{
   

public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',

        // Basic info
        'title' => 'required|string|max:100',
        'description' => 'required|string|max:2000',
        'street' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'max_guests' => 'required|integer|min:1',

        // Pricing
        'base_price' => 'required|numeric|min:0',
        'currency' => 'required|string|size:3',
        'weekend_price' => 'nullable|numeric|min:0',

        // Rules
        'house_rules' => 'nullable|string',
        'cancellation_policy' => 'required|in:flexible,moderate,strict',
        'check_in_time' => 'required',
        'check_out_time' => 'required',
        'minimum_stay' => 'required|integer|min:1',
        'maximum_stay' => 'nullable|integer|gte:minimum_stay',

        // Apartment
        'bedrooms' => 'nullable|integer|min:0',
        'bathrooms' => 'nullable|integer|min:0',

        // Excursion
        'duration' => 'nullable|string|max:100',
        'difficulty_level' => 'nullable|string|max:100',
        'group_size_min' => 'nullable|integer|min:1',
        'group_size_max' => 'nullable|integer|gte:group_size_min',
        'whats_included' => 'nullable|string',

        // Car
        'vehicle_make' => 'nullable|string|max:100',
        'vehicle_model' => 'nullable|string|max:100',
        'vehicle_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        'transmission_type' => 'nullable|string|max:50',
        'fuel_type' => 'nullable|string|max:50',
        'mileage_limit_per_day' => 'nullable|integer|min:0',

        'is_draft' => 'boolean'
    ]);

    $validated['user_id'] = Auth::id();
    $validated['status'] = 'pending';

    $listing = Listing::create($validated);

    return response()->json([
        'message' => 'Listing created successfully.',
        'data' => $listing
    ], 201);
}

}
