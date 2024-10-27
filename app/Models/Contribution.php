<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
        'campaign_id',
        'amount',
        'contributor',
    ];

    // Define the relationship with the Campaign model
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
