<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Offer extends Model
{
       use HasTranslations;
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
        'status'=>stateStatusEnum::class,
    ];


    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
