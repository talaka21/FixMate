<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
     protected $fillable = [
        'title',
        'image',
        'service_provider_id',
        'start_date',
        'expire_date',
        'status',
     ];
      protected $casts = [
        'start_date' => 'date',
        'expire_date' => 'date',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
