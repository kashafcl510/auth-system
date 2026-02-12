<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Listing extends Model
{
     protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'street',
        'city',
        'state',
        'country',
        'max_guests',
        'base_price',
        'currency',
        'weekend_price',
        'house_rules',
        'cancellation_policy',
        'check_in_time',
        'check_out_time',
        'minimum_stay',
        'maximum_stay',
        'bedrooms',
        'bathrooms',
        'duration',
        'difficulty_level',
        'group_size_min',
        'group_size_max',
        'whats_included',
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'transmission_type',
        'fuel_type',
        'mileage_limit_per_day',
        'status',
        'rejection_reason',
        'admin_notes',
        'view_count',
        'is_draft'
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'base_price' => 'decimal:2',
        'weekend_price' => 'decimal:2',
    ];


    //relationships
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
