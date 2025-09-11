<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
       use HasTranslations;
   protected $fillable = [
        'title',
        'image',
        'service_provider_id',
        'status',
    ];
      protected $casts = [
       'status'=>stateStatusEnum::class,
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
     public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
