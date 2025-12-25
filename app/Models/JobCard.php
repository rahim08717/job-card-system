<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_card_no',
        'vehicle_id',
        'entry_date_time',
        'expected_delivery_date',
        'status',
        'mechanic_name',
        'customer_complaints', // Stores JSON
        'inspection_checklist', // Stores JSON
        'grand_total'
    ];


    protected $casts = [
        'entry_date_time' => 'datetime',
        'expected_delivery_date' => 'date',
        'customer_complaints' => 'array',    // JSON -> Array
        'inspection_checklist' => 'array',   // JSON -> Array
    ];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

  
    public function services()
    {
        return $this->hasMany(JobCardService::class);
    }
}
