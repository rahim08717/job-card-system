<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCardService extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_card_id',
        'service_name',
        'price',
        'quantity',
        'total_price'
    ];

    public function jobCard()
    {
        return $this->belongsTo(JobCard::class);
    }
}
