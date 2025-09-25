<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;

class GovernmentEntity extends Model  implements HasMedia
{
  use HasTranslations;
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'description',
        'image',
        'phone',
        'website',
        'state_id',
        'city_id',
        'status',
    ];
     public $translatable = ['name', 'description'];
    protected $casts = [
        'status' => stateStatusEnum::class,
    ];
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getThumbnailUrlAttribute()
{

    if ($this->hasMedia('thumbnails')) {
        return $this->getFirstMediaUrl('thumbnails');
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
        $this->addMediaCollection('thumbnails')->singleFile();
    }
}
