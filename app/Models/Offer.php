<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Offer extends Model implements HasMedia
{
       use HasTranslations, InteractsWithMedia;
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
    public function getThumbnailUrlAttribute(): string
{
    if ($this->hasMedia('image')) {
        return $this->getFirstMediaUrl('image');
    }


    if (file_exists(storage_path('app/public/default.png'))) {
        return asset('storage/default.png');
    }


    if (file_exists(public_path('images/default.png'))) {
        return asset('images/default.png');
    }


    return 'https://via.placeholder.com/300x200.png?text=No+Image';
}
     public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }
}
