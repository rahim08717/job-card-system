<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // These fields are allowed to be inserted into the database
    protected $fillable = ['name', 'mobile', 'address'];

    /**
     * Relationship: A customer can have multiple vehicles.
     * Logic: One-to-Many
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
