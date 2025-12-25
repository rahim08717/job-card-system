<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

   protected $fillable = [
    'customer_id',
    'vehicle_number',
    'vehicle_type',
    'brand',
    'model',
    'year',
    'engine_no',
    'chassis_no',
    'fuel_type',
    'mileage'
];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

   
    public function jobCards()
    {
        return $this->hasMany(JobCard::class);
    }
}
